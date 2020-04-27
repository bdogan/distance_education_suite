<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use BackOffice\Controller\AppController;
use BackOffice\Lib\App;

/**
 * LessonTopicVideos Controller
 *
 *
 * @method \BackOffice\Model\Entity\LessonTopicVideo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \App\Model\Table\LessonTopicVideosTable $LessonTopicVideos;
 */
class LessonTopicVideosController extends AppController
{

    /**
     * @var string
     */
    protected $modelClass = 'LessonTopicVideos';

    /**
     * @var \App\Model\Table\ConnectedAppsTable
     */
    protected $ConnectedApps;

    /**
     * @param int $lesson_topic_id
     */
    public function index($lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicVideos->LessonTopics->get($lesson_topic_id);
        $lessonTopicVideos = $this->paginate($this->LessonTopicVideos, [
            'finder' => [
                'byLesson' => [
                    'lesson' => $lesson
                ]
            ]
        ]);
        $this->set(compact('lessonTopicVideos', 'lesson'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Topic Video id.
     * @param string|null $lesson_topic_id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicVideos->LessonTopics->get($lesson_topic_id, [
            'contain' => [ 'ClassRooms' ]
        ]);
        $lessonTopicVideo = $this->LessonTopicVideos->get($id);
        $this->set(compact('lessonTopicVideo', 'lesson'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($lesson_topic_id = null)
    {
        $this->loadModel('ConnectedApps');
        $apps = $this->ConnectedApps->find('all', [ 'linked' => true, 'role' => App::ROLE_VIDEO_HOST ]);
        $lesson = $this->LessonTopicVideos->LessonTopics->get($lesson_topic_id);
        $lessonTopicVideo = $this->LessonTopicVideos->newEmptyEntity();
        if ($this->request->is('post')) {
            $lessonTopicVideo = $this->LessonTopicVideos->patchEntity($lessonTopicVideo, $this->request->getData());
            $lessonTopicVideo->lesson_topic_id = $lesson->id;
            if ($this->LessonTopicVideos->save($lessonTopicVideo)) {
                $this->Flash->success(__('The lesson topic video has been saved.'));

                return $this->redirect(['action' => 'index', $lesson->id]);
            }
            $this->Flash->error(__('The lesson topic video could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonTopicVideo', 'lesson', 'apps'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Topic Video id.
     * @param string|null $lesson_topic_id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $lesson_topic_id = null)
    {
        $this->loadModel('ConnectedApps');
        $apps = $this->ConnectedApps->find('all', [ 'linked' => true, 'role' => App::ROLE_VIDEO_HOST ]);
        $lesson = $this->LessonTopicVideos->LessonTopics->get($lesson_topic_id);
        $lessonTopicVideo = $this->LessonTopicVideos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonTopicVideo = $this->LessonTopicVideos->patchEntity($lessonTopicVideo, $this->request->getData());
            if ($this->LessonTopicVideos->save($lessonTopicVideo)) {
                $this->Flash->success(__('The lesson topic video has been saved.'));

                return $this->redirect(['action' => 'index', $lesson->id]);
            }
            $this->Flash->error(__('The lesson topic video could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonTopicVideo', 'lesson', 'apps'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Topic Video id.
     * @param string|null $lesson_topic_id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $lesson_topic_id = null)
    {
        $lesson = $this->LessonTopicVideos->LessonTopics->get($lesson_topic_id);
        $this->request->allowMethod(['post', 'delete']);
        $lessonTopicVideo = $this->LessonTopicVideos->get($id);
        if ($this->LessonTopicVideos->delete($lessonTopicVideo)) {
            $this->Flash->success(__('The lesson topic video has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson topic video could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $lesson->id]);
    }
}
