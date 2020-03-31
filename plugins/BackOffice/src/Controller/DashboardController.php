<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use Cake\Routing\Router;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController
{

    /**
     * @param mixed ...$path
     *
     * @return \Cake\Http\Response|null
     */
    public function index(...$path)
    {
        // Redirect if comes from full url
        if (!$path) {
            return $this->redirect(Router::url([ 'home' ]));
        }
    }
}
