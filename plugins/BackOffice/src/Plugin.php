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

/**
 * Plugin for BackOffice
 */
class Plugin extends BasePlugin
{

    use InstanceConfigTrait;

    /**
     * @var array
     */
    protected $_defaultConfig = [
        'prefix' => '/panel',
        'home_page' => 'bo_home',
        'pages' => [
            // Static pages
            'bo_home' => [ '/', [ 'controller' => 'Dashboard', 'action' => 'index', 'home' ] ],
            'bo_login' => [ '/users/login', [ 'controller' => 'Users', 'action' => 'login' ] ],
            'bo_logout' => [ '/users/logout', [ 'controller' => 'Users', 'action' => 'logout' ] ],

            // DLS
            'bo_class_rooms' => [ '/class_rooms', [ 'controller' => 'ClassRooms', 'action' => 'index' ] ],
            'bo_class_room_view' => [ '/class_room/{id}', [ 'controller' => 'ClassRooms', 'action' => 'view' ], [ 'pass' => [ 'id' ] ] ],
            'bo_class_room_add' => [ '/class_room/new', [ 'controller' => 'ClassRooms', 'action' => 'add' ] ],
            'bo_class_room_edit' => [ '/class_room/{id}/edit', [ 'controller' => 'ClassRooms', 'action' => 'edit' ], [ 'pass' => [ 'id' ] ] ],
            'bo_class_room_delete' => [ '/class_room/{id}/delete', [ 'controller' => 'ClassRooms', 'action' => 'delete' ], [ 'pass' => [ 'id' ] ] ]

        ]
    ];

    /**
     * Init
     */
    public function initialize(): void
    {
        parent::initialize();
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
                    /*
                    $methods = is_array($page[0]) ? $page[0] : [ $page[0] ];
                    foreach ($methods as $method) {
                        $result = $builder->{$method}($page[1], $page[2], (!$builder->nameExists($name) ? $name : $name . '_' . $method));
                        if (isset($page[3])) {
                            $result = $result->setPass(array_keys($page[3]));
                            $result->setPatterns(array_values($page[3]));
                        }
                    }*/
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
