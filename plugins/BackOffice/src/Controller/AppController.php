<?php
declare(strict_types=1);

namespace BackOffice\Controller;

use BackOffice\View\BackOfficeView;
use Cake\Controller\Controller;
use Cake\Core\Configure;

/**
 * Class AppController
 *
 * @package BackOffice\Controller
 *
 * @property-read \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class AppController extends Controller
{

    /**
     * @var \BackOffice\Plugin
     */
    protected $BackOffice;

    /**
     * @throws \Exception
     */
    public function initialize(): void
    {
        // Parent call
        parent::initialize();

        // Set view class
        $this->viewBuilder()->setClassName(BackOfficeView::class);

        // Load components
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');

        // Set BackOffice
        $this->BackOffice = Configure::read('BackOffice');
    }

}
