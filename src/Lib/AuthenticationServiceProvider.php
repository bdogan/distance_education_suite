<?php

namespace App\Lib;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationServiceProvider implements AuthenticationServiceProviderInterface
{

    /**
     * @var array
     */
    protected $loginRoute;

    /**
     * AuthenticationServiceProvider constructor.
     *
     * @param $loginUrl
     */
    public function __construct($loginRoute)
    {
        $this->loginRoute = $loginRoute;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService( ServerRequestInterface $request ): AuthenticationServiceInterface
    {
        $loginUrl = Router::url($this->loginRoute);

        $service = new AuthenticationService();

        $service->setConfig([
            'unauthenticatedRedirect' => $loginUrl,
            'queryParam' => 'redirect'
        ]);

        $fields = [
            'username' => 'tc_kimlik',
            'password' => 'user.password'
        ];

        // Loads the authenticators
        $service->loadAuthenticator('Authentication.Session', [
            'sessionKey' => 'auth'
        ]);
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => $loginUrl
        ]);
        $service->loadAuthenticator('Authentication.Cookie', [
            'rememberMeField' => 'remember_me',
            'fields' => $fields,
            'loginUrl' => $loginUrl,
            'cookie' => [
                'name' => 'auth_cookie'
            ]
        ]);

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', [
            'fields' => $fields,
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'Students',
                'finder' => 'admins'
            ]
        ]);

        return $service;
    }

}
