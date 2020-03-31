<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use BackOffice\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{

    protected $modelClass = 'User';

    /**
     * @param \Cake\Event\EventInterface $event
     *
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter( EventInterface $event )
    {
        $this->Authentication->allowUnauthenticated([ 'login' ]);
        $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? $this->BackOffice->getHomeRoute();
            return $this->redirect($target);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->set('Geçersiz e-posta adresi veya şifre', [ 'element' => 'BackOffice.login_info', 'params' => [ 'class' => 'text-danger' ]]);
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
        $this->redirect($this->BackOffice->getHomeRoute());
    }
}
