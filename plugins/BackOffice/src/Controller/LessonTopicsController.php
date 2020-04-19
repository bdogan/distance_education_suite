<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use BackOffice\Controller\AppController;

/**
 * LessonTopics Controller
 *
 *
 * @method \App\Model\Entity\LessonTopic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \App\Model\Table\LessonTopicsTable $LessonTopics
 */
class LessonTopicsController extends AppController
{
    /**
     * @var string
     */
    public $modelClass = 'LessonTopics';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $lessonTopics = $this->paginate($this->LessonTopics, [
            'contain' => [ 'ClassRooms' ],
            'sortWhitelist' => [ 'id', 'lesson', 'subject', 'created', 'modified', 'ClassRooms.name' ]
        ]);

        $this->set(compact('lessonTopics'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonTopic = $this->LessonTopics->get($id, [
            'contain' => [
                'ClassRooms',
                'LessonTopicFiles' => [ 'fields' => [ 'lesson_topic_id', 'id' ] ],
                'LessonTopicVideos' => [ 'fields' => [ 'lesson_topic_id', 'id' ] ]
            ],
        ]);

        $this->set('lessonTopic', $lessonTopic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonTopic = $this->LessonTopics->newEmptyEntity();
        if ($this->request->is('post')) {
            $lessonTopic = $this->LessonTopics->patchEntity($lessonTopic, $this->request->getData());
            if ($this->LessonTopics->save($lessonTopic)) {
                $this->Flash->success(__('The lesson topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson topic could not be saved. Please, try again.'));
        }
        $classRooms = $this->LessonTopics->ClassRooms->find('list', [ 'limit' => 200 ]);
        $this->set(compact('lessonTopic', 'classRooms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonTopic = $this->LessonTopics->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonTopic = $this->LessonTopics->patchEntity($lessonTopic, $this->request->getData());
            if ($this->LessonTopics->save($lessonTopic)) {
                $this->Flash->success(__('The lesson topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson topic could not be saved. Please, try again.'));
        }
        $classRooms = $this->LessonTopics->ClassRooms->find('list', [ 'limit' => 200 ]);
        $this->set(compact('lessonTopic', 'classRooms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Topic id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonTopic = $this->LessonTopics->get($id);
        if ($this->LessonTopics->delete($lessonTopic)) {
            $this->Flash->success(__('The lesson topic has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson topic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
