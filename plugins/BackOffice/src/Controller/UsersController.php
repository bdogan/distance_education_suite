<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use Cake\Event\EventInterface;
use Carbon\Carbon;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users;
 */
class UsersController extends AppController
{

    protected $modelClass = 'Users';

    /**
     * @param \Cake\Event\EventInterface $event
     *
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter( EventInterface $event )
    {
        $this->Authentication->allowUnauthenticated([ 'login' ]);
    }

    /**
     * Profile
     */
    public function profile()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->getIdentifier());
        unset($user->password);
        $this->set(compact('user'));
    }

    /**
     * Change Password
     *
     * @return \Cake\Http\Response|null
     */
    public function changePassword()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->getIdentifier());
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user->password = $this->request->getData('new_password');
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'validate' => 'changePassword'
            ]);
            if ($this->Users->save($user)) {
                $this->Flash->set(__('The password has been changed. Please login with new credentials.'), [ 'element' => 'BackOffice.login_info', 'params' => [ 'class' => 'text-success text-center' ] ]);

                return $this->redirect([ 'action' => 'logout' ]);
            }
            $this->Flash->error(__('The password could not be changed. Please, try again.'));
        }
        unset($user->password);
        $this->set(compact('user'));
    }

    /**
     * Edit Profile
     *
     * @return \Cake\Http\Response|null
     */
    public function editProfile()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->getIdentifier());
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($user->password)) unset($user->password);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The profile has been saved.'));
                $this->Authentication->setIdentity($user);

                return $this->redirect([ 'action' => 'profile' ]);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        unset($user->password);
        $this->set(compact('user'));
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

            /** @var \App\Model\Entity\User $user */
            $user = $this->Authentication->getIdentity()->getOriginalData();
            $user->last_login = Carbon::now();
            $this->Users->save($user);

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
