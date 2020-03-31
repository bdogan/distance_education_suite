<?php

namespace BackOffice\Lib;

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
        $loginUrl = Router::url($this->loginRoute + [ 'plugin' => 'BackOffice' ]);

        $service = new AuthenticationService();

        $service->setConfig([
            'unauthenticatedRedirect' => $loginUrl,
            'queryParam' => 'redirect'
        ]);

        $fields = [
            'username' => 'email',
            'password' => 'password'
        ];

        // Loads the authenticators
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => $loginUrl
        ]);
        $service->loadAuthenticator('Authentication.Cookie',[
            'rememberMeField' => 'remember_me',
            'fields' => $fields,
            'loginUrl' => $loginUrl
        ]);

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', [
            'fields' => $fields,
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'Users',
                'finder' => 'all'
            ]
        ]);

        return $service;
    }
}
