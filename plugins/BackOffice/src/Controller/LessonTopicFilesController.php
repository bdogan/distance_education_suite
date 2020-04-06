<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use BackOffice\Controller\AppController;

/**
 * LessonTopicFiles Controller
 *
 *
 * @method \BackOffice\Model\Entity\LessonTopicFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \App\Model\Table\LessonTopicFilesTable $LessonTopicFiles;
 */
class LessonTopicFilesController extends AppController
{

    /**
     * @var string
     */
    public $modelClass = 'LessonTopicFiles';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicFiles->LessonTopics->get($lesson_topic_id);
        $lessonTopicFiles = $this->paginate($this->LessonTopicFiles, [
            'finder' => [
                'byLesson' => [
                    'lesson' => $lesson
                ]
            ]
        ]);
        $this->set(compact('lessonTopicFiles', 'lesson'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Topic File id.
     * @param string|null $lesson_topic_id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicFiles->LessonTopics->get($lesson_topic_id, [
            'contain' => [ 'ClassRooms' ]
        ]);
        $lessonTopicFile = $this->LessonTopicFiles->get($id);
        $this->set(compact('lessonTopicFile', 'lesson'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicFiles->LessonTopics->get($lesson_topic_id);
        $lessonTopicFile = $this->LessonTopicFiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $lessonTopicFile = $this->LessonTopicFiles->patchEntity($lessonTopicFile, $this->request->getData());
            $lessonTopicFile->lesson_topic_id = $lesson->id;
            if ($file = $this->request->getUploadedFile('_file')) {
                $lessonTopicFile->name = $file->getClientFilename();
                $lessonTopicFile->type = $file->getClientMediaType();
                $lessonTopicFile->size = $file->getSize();
            }
            if ($this->LessonTopicFiles->save($lessonTopicFile)) {
                $file->moveTo(UPLOAD_PATH . $file->getClientFilename());
                $this->Flash->success(__('The lesson topic file has been saved.'));

                return $this->redirect(['action' => 'index', $lesson->id]);
            }
            $this->Flash->error(__('The lesson topic file could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonTopicFile', 'lesson'));
    }

    public function show($id = null, $lesson_topic_id = null)
    {
        $this->request->allowMethod(['get']);
        $lessonTopicFile = $this->LessonTopicFiles->get($id);
        return $this->response->withFile(UPLOAD_PATH . $lessonTopicFile->name);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Topic File id.
     * @param string|null $lesson_topic_id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicFiles->LessonTopics->get($lesson_topic_id);
        $this->request->allowMethod(['post', 'delete']);
        $lessonTopicFile = $this->LessonTopicFiles->get($id);
        if ($this->LessonTopicFiles->delete($lessonTopicFile)) {
            $this->Flash->success(__('The lesson topic file has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson topic file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $lesson->id]);
    }
}
