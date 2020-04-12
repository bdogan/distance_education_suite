<?php

namespace BackOffice\Lib\App;

use App\Model\Entity\ConnectedApp;
use BackOffice\Lib\App;
use Cake\Core\Configure;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Cake\View\Helper\HtmlHelper;
use Vimeo\Vimeo;

class VimeoApp extends App
{

    /**
     * Data
     */
    public $alias = 'vimeo';
    public $name = 'Vimeo';
    public $logo = 'vimeo.svg';
    public $description = 'Ders videoları için güvenli bir saklama alanı sunar.';
    public $scopes = [ 'public', 'private', 'create', 'edit', 'delete', 'interact', 'video_files' ];
    public $roles = [ self::ROLE_VIDEO_HOST ];

    /**
     * @var \Vimeo\Vimeo
     */
    private $_api;
    public function api()
    {
        return $this->_api ?? ($this->_api = new Vimeo(Configure::readOrFail('vimeo.clientId'), Configure::readOrFail('vimeo.clientSecret')));
    }

    /**
     * @return string|string[]
     */
    private function generateState()
    {
        return str_replace('-', '', Text::uuid());
    }

    /**
     * @param \Cake\Http\ServerRequest $request
     * @param \Cake\Http\Response $response
     *
     * @return \Cake\Http\Response
     */
    public function connect( ServerRequest $request, Response $response ): Response
    {
        // Create State
        $state = $this->generateState();
        $request->getSession()->write($this->alias . '_state', $state);

        // Generate Uri
        $uri = $this->api()->buildAuthorizationEndpoint(Router::url([ '_name' => 'bo_app_callback', 'alias' => $this->alias ], true), $this->scopes, $state);

        // Redirect
        return $response->withStatus(302)->withLocation($this->withGateway($uri));
    }

    /**
     * @param \Cake\Http\ServerRequest $request
     * @param \Cake\Http\Response $response
     *
     * @return \App\Model\Entity\ConnectedApp
     * @throws \Exception
     */
    public function callback( ServerRequest $request, Response $response ): ConnectedApp
    {
        $state = $request->getQuery('state');
        $code = $request->getQuery('code');
        if (!$state || $request->getSession()->consume($this->alias . '_state') !== $state || !$code ) {
            throw new BadRequestException();
        }
        $tokens = $this->api()->accessToken($code, $this->gatewayCallback());
        if ($tokens['status'] === 200) {
            $connectedApp = new ConnectedApp();
            $connectedApp->alias = $this->alias;
            $connectedApp->token_type = $tokens['body']['token_type'];
            $connectedApp->access_token = $tokens['body']['access_token'];
            $connectedApp->scope = json_encode(explode(' ', $tokens['body']['scope']));
            $connectedApp->user = json_encode($tokens['body']['user']);
            return $connectedApp;
        }
        Log::write(LOG_ERR, 'Vimeo response unexpected', $tokens);
        throw new \Exception('Beklenmedik bir hata ile karşılaşıldı. Lütfen tekrar deneyin.');
    }

}
