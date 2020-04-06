<?php
declare(strict_types=1);

namespace BackOffice\Controller;

/**
 * Students Controller
 *
 *
 * @method \BackOffice\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    public $modelClass = 'Students';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $students = $this->paginate($this->Students, [
            'contain' => [ 'Users', 'ClassRooms' ],
            'sortWhitelist' => [ 'id', 'created', 'modified', 'Users.name', 'Users.email', 'ClassRooms.name' ]
        ]);

        $this->set(compact('students'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [ 'Users', 'ClassRooms' ],
        ]);

        $this->set('student', $student);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEmptyEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData(), [
                'associated' => [
                    'Users' => [
                        'validate' => 'student'
                    ]
                ]
            ]);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $classRooms = $this->Students->ClassRooms->find('list', [ 'limit' => 200 ]);
        $this->set(compact('student', 'classRooms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [ 'Users' ],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData(), [
                'associated' => [
                    'Users' => [
                        'validate' => 'student'
                    ]
                ]
            ]);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $classRooms = $this->Students->ClassRooms->find('list', [ 'limit' => 200 ]);
        $this->set(compact('student', 'classRooms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
