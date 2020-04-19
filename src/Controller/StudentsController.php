<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class StudentsController extends AppController
{

    protected $modelClass = 'Students';

    public function beforeFilter( EventInterface $event )
    {
        parent::beforeFilter( $event );
        $this->Authentication->allowUnauthenticated([ 'login' ]);
    }

    /**
     * Login
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? [ 'controller' => 'Pages', 'action' => 'home' ];
            return $this->redirect($target);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->set('Geçersiz kimlik numarası veya şifre', [ 'element' => 'BackOffice.login_info', 'params' => [ 'class' => 'text-danger' ]]);
        } else {
            $this->Flash->set('Lütfen gerekli bilgileri doldurunuz', [ 'element' => 'BackOffice.login_info' ]);
        }
    }

    /**
     *
     */
    public function logout()
    {
        $this->Authentication->logout();
        $this->redirect([ 'controller' => 'Pages', 'action' => 'home' ]);
    }
}
