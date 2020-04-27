<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use Cake\Http\Exception\NotFoundException;

/**
 * ConnectedApps Controller
 *
 *
 * @method \App\Model\Entity\ConnectedApp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property \App\Model\Table\ConnectedAppsTable $ConnectedApps;
 */
class ConnectedAppsController extends AppController
{

    /**
     * @var string ModelClass
     */
    protected $modelClass = 'ConnectedApps';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->request->allowMethod([ 'get' ]);
        $connectedApps = $this->ConnectedApps->find('all');
        $this->set(compact('connectedApps'));
    }

    /**
     * @param string $alias
     *
     * @return \Cake\Http\Response
     */
    public function connect(string $alias)
    {
        $this->request->allowMethod([ 'get' ]);
        $this->autoRender = false;

        /** @var \BackOffice\Lib\App $app, */
        $app = $this->ConnectedApps->find('all', [ 'alias' => $alias ])->firstOrFail();

        // Return response
        return $app->connect($this->getRequest(), $this->getResponse());
    }

    /**
     * @param string $alias
     *
     * @return \Cake\Http\Response|null
     */
    public function callback(string $alias)
    {
        $this->request->allowMethod([ 'get' ]);
        $this->autoRender = false;

        /** @var \BackOffice\Lib\App $app */
        $app = $this->ConnectedApps->find('all', [ 'alias' => $alias ])->firstOrFail();

        // Save
        try {
            $connectedApp = $app->callback($this->getRequest(), $this->getResponse());
            if ($this->ConnectedApps->save($connectedApp)) {
                $this->Flash->success(__('{0} successfully connected.', $app->name));
            } else {
                $this->Flash->error(__('{0} cloud not be connected. Please, try again.', $app->name));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('{0} occured. {0} cloud not be connected. Please, try again.', $e->getMessage(), $app->name));
        }

        // Redirect to index
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string $alias
     *
     * @return \Cake\Http\Response|null
     */
    public function disconnect(string $alias)
    {
        $this->request->allowMethod([ 'get' ]);
        $this->autoRender = false;

        /** @var \BackOffice\Lib\App $app */
        $app = $this->ConnectedApps->find('all', [ 'alias' => $alias ])->firstOrFail();

        // Unlink
        if (!!$app->ConnectedApp && $this->ConnectedApps->delete($app->ConnectedApp)) {
            $this->Flash->success(__('{0} successfully unlinked.', $app->name));
        } else {
            $this->Flash->error(__('{0} cloud not be unlinked. Please, try again.', $app->name));
        }

        // Redirect to index
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string $alias
     * @param string $method
     */
    public function call_app_method(string $alias, string $method)
    {
        $this->autoRender = false;

        /** @var \BackOffice\Lib\App $app */
        $app = $this->ConnectedApps->find('all', [ 'alias' => $alias, 'linked' => true ])->firstOrFail();

        // Check application method
        if (!method_exists($app, $method)) {
            throw new NotFoundException($method . ' not found on application ' . $alias);
        }

        // Call application method
        return $app->{$method}($this->request->withAttribute('controller', $this), $this->response);
    }
}
