<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use App\Lib\AuthenticationServiceProvider;
use Authentication\Middleware\AuthenticationMiddleware;
use BackOffice\Plugin;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\Middleware\EncryptedCookieMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\RouteBuilder;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {

        $this->addPlugin('BackOffice');

        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        // Add backoffice
        $this->addPlugin(Plugin::class);

        // Load more plugins here
        $this->addPlugin('AssetCompress');

        // Add authentication plugin
        $this->addPlugin(\Authentication\Plugin::class);

    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }

    public function routes( RouteBuilder $routes ): void
    {
        $routes->scope(
            '/',
            function (RouteBuilder $builder) {

                // Body Parser
                $builder->registerMiddleware('body_parser', new BodyParserMiddleware([
                    'json' => true
                ]));
                $builder->applyMiddleware('body_parser');

                // Encrypted Cookie
                $builder->registerMiddleware('encrypt_cookie', new EncryptedCookieMiddleware(
                    [ 'auth_cookie' ],
                    Configure::readOrFail('Security.cookieKey')
                ));
                $builder->applyMiddleware('encrypt_cookie');

                // Csrf
                $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware());
                $builder->applyMiddleware('csrf');

                // Authentication middleware
                $builder->registerMiddleware('auth', new AuthenticationMiddleware(new AuthenticationServiceProvider([ 'controller' => 'Students', 'action' => 'login' ])));
                $builder->applyMiddleware('auth');

                $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);
                $builder->connect('/students/login', ['controller' => 'Students', 'action' => 'login']);
                $builder->connect('/students/logout', ['controller' => 'Students', 'action' => 'logout']);
                $builder->connect('/lesson_topic/{id}/view', [ 'controller' => 'LessonTopics', 'action' => 'view' ], [ 'pass' => [ 'id' ] ]);
                $builder->connect('/lesson_topic/{lessonTopicId}/file/{id}', [ 'controller' => 'LessonTopicFiles', 'action' => 'show' ], [ 'pass' => [ 'lessonTopicId', 'id' ] ]);
                $builder->connect('/lesson_topic/{lessonTopicId}/video/{id}', [ 'controller' => 'LessonTopicVideos', 'action' => 'show' ], [ 'pass' => [ 'lessonTopicId', 'id' ] ]);
                $builder->connect('/lesson_topic/{lessonTopicId}/video/{id}/logs', [ 'controller' => 'StudentVideoLogs', 'action' => 'read' ], [ 'pass' => [ 'lessonTopicId', 'id' ] ]);
                $builder->connect('/lesson_topic/{lessonTopicId}/video/{id}/log/{event}', [ 'controller' => 'StudentVideoLogs', 'action' => 'write' ], [ 'pass' => [ 'lessonTopicId', 'id', 'event' ] ]);
            }
        );
    }


    /**
     * Bootrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }
}
