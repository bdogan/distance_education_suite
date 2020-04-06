<?php
declare(strict_types=1);

namespace BackOffice;

use Authentication\Middleware\AuthenticationMiddleware;
use BackOffice\Lib\AuthenticationServiceProvider;
use Cake\Collection\Collection;
use Cake\Core\BasePlugin;
use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\Middleware\EncryptedCookieMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Utility\Inflector;

/**
 * Plugin for BackOffice
 */
class Plugin extends BasePlugin
{

    const ROUTE_PREFIX = 'bo_';

    use InstanceConfigTrait;

    /**
     * @var array
     */
    protected $_defaultConfig;

    /**
     * Init
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->_defaultConfig = [
            'prefix' => '/panel',
            'home_page' => 'bo_home',
            'pages' => [
                // Static pages
                'bo_home' => [ '/', [ 'controller' => 'Dashboard', 'action' => 'index', 'home' ] ],
                'bo_login' => [ '/users/login', [ 'controller' => 'Users', 'action' => 'login' ] ],
                'bo_logout' => [ '/users/logout', [ 'controller' => 'Users', 'action' => 'logout' ] ],
                'bo_profile' => [ '/profile', [ 'controller' => 'Users', 'action' => 'profile' ] ],
                'bo_profile_edit' => [ '/profile/edit', [ 'controller' => 'Users', 'action' => 'edit_profile' ] ],
                'bo_change_password' => [ '/profile/change_password', [ 'controller' => 'Users', 'action' => 'change_password' ] ]
            ]

        ];

        // CRUDs
        $this->addCrud('class_rooms');
        $this->addCrud('students');
        $this->addCrud('lesson_topics');
        $this->addCrud('lesson_topic_files', [
            'actions' => [ 'index', 'view', 'add', 'delete', 'show' ],
            'prepend' => '/lesson_topics/{lesson_topic_id}',
            'pass' => [ 'lesson_topic_id' ],
            'routes' => [
                'singular' => 'file',
                'plural' => 'files'
            ]
        ]);

        Configure::write('BackOffice', $this);
    }

    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {

        // Add AssetCompress
        $app->addPlugin(\AssetCompress\Plugin::class);

        // Add authentication plugin
        $app->addPlugin(\Authentication\Plugin::class);

    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getPage($name)
    {
        $pages = new Collection($this->getPages());
        return $pages->filter(function($page, $_name) use ($name) {
           return $name === $_name;
        })->first();
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getRoute($name)
    {
        $page = $this->getPage($name);
        return $page[1];
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->getConfig('pages');
    }

    /**
     * @param $name
     * @param $options
     */
    public function setPage($name, $options)
    {
        $this->setConfig('pages.' . $name, $options);
    }

    /**
     * @param $pluralName
     * @param array $actions
     */
    public function addCrud($pluralName, $options = [])
    {
        $singularName = Inflector::singularize($pluralName);
        $controllerName = Inflector::pluralize(Inflector::classify($singularName));

        $options = array_replace([
            'actions' => [ 'index', 'view', 'add', 'edit', 'delete' ],
            'prepend' => '',
            'pass' => [],
            'routes' => [
                'singular' => $singularName,
                'plural' => $pluralName
            ]
        ], $options);

        foreach ( $options['actions'] as $action ) {
            $name = self::ROUTE_PREFIX . ($action === 'index' ? $pluralName : ($singularName . '_' . $action));
            switch ($action) {
                case 'index':
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['plural'], [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => $options['pass'] ] ]);
                    break;
                case 'view':
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['singular'] . '/{id}', [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => array_merge([ 'id' ], $options['pass']), 'id' => '[0-9]+' ] ]);
                    break;
                case 'add':
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['singular'] . '/new', [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => $options['pass'] ] ]);
                    break;
                case 'edit':
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['singular'] . '/{id}/edit', [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => array_merge([ 'id' ], $options['pass']), 'id' => '[0-9]+' ] ]);
                    break;
                case 'delete':
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['singular'] . '/{id}/delete', [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => array_merge([ 'id' ], $options['pass']), 'id' => '[0-9]+' ] ]);
                    break;
                default:
                    $this->setPage($name, [ $options['prepend'] . '/' . $options['routes']['singular'] . '/{id}/' . $action, [ 'controller' => $controllerName, 'action' => $action ], [ 'pass' => array_merge([ 'id' ], $options['pass']), 'id' => '[0-9]+' ] ]);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        return $this->getPage($this->getConfig('home_page'));
    }

    /**
     * @return string
     */
    public function getHomeRoute()
    {
        $homePage = $this->getHomePage();
        return Router::url($homePage[1]);
    }

    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void
    {
        $routes->plugin(
            'BackOffice',
            [ 'path' => $this->getConfig('prefix') ],
            function (RouteBuilder $builder) {

                // Encrypted Cookie
                $builder->registerMiddleware('encrypt_cookie', new EncryptedCookieMiddleware(
                    [ 'CookieAuth' ],
                    Configure::readOrFail('Security.cookieKey')
                ));
                $builder->applyMiddleware('encrypt_cookie');

                // Csrf
                $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware());
                $builder->applyMiddleware('csrf');

                // Authentication middleware
                $builder->registerMiddleware('auth', new AuthenticationMiddleware(new AuthenticationServiceProvider($this->getRoute('bo_login'))));
                $builder->applyMiddleware('auth');

                // Set routes
                $pages = $this->getPages();
                foreach ($pages as $name => $page) {
                    $options = [ '_name' => $name ];
                    if (!isset($page[2])) $page[2] = [];
                    $builder->connect($page[0], $page[1], $options + $page[2]);
                }
            }
        );
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Return to chain
        return $middlewareQueue;
    }
}
