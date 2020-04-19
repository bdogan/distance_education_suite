<?php

namespace BackOffice\Lib;

use App\Model\Entity\ConnectedApp;
use Cake\Core\Configure;
use Cake\Http\Exception\NotImplementedException;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\Helper\HtmlHelper;

class App
{
    /**
     * Roles
     */
    const ROLE_VIDEO_HOST = 'video_host';

    /**
     * @var string Alias
     */
    public $alias;

    /**
     * @var string Logo
     */
    public $logo;

    /**
     * @var string Name
     */
    public $name;

    /**
     * @var string Description
     */
    public $description;

    /**
     * @var string[] Scopes
     */
    public $scopes;

    /**
     * @var string[] Roles
     */
    public $roles;

    /**
     * @var ConnectedApp
     */
    public $ConnectedApp = null;

    /**
     * Initialize
     */
    protected function initialize() { }

    /**
     * @param \Cake\View\Helper\HtmlHelper $Html
     * @param array $options
     *
     * @return string
     */
    public function getLogo(HtmlHelper $Html, $options = [])
    {
        return $Html->image($this->logo, [ 'class' => 'card-img-top' ] + $options);
    }

    /**
     * @param \Cake\Http\ServerRequest $request
     * @param \Cake\Http\Response $response
     *
     * @return \Cake\Http\Response
     */
    public function connect(ServerRequest $request, Response $response): Response
    {
        return $response;
    }

    /**
     * @param \Cake\Http\ServerRequest $request
     * @param \Cake\Http\Response $response
     *
     * @return ConnectedApp
     */
    public function callback(ServerRequest $request, Response $response): ConnectedApp
    {
        throw new NotImplementedException();
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function withGateway(string $url)
    {
        $parsedUri = parse_url($url);
        $query = $parsedUri['query'];
        $gatewayAuthUri = Configure::readOrFail('account.gateway.authorize');
        $gatewayAuthUri = str_replace([ '{{id}}', '{{app}}' ], [ Configure::readOrFail('account.id'), $this->alias ], $gatewayAuthUri);
        return $gatewayAuthUri . '?' . $query;
    }

    /**
     * @return mixed|string|string[]
     */
    public function gatewayCallback()
    {
        $gatewayAuthUri = Configure::readOrFail('account.gateway.callback');
        $gatewayAuthUri = str_replace([ '{{id}}', '{{app}}' ], [ Configure::readOrFail('account.id'), $this->alias ], $gatewayAuthUri);
        return $gatewayAuthUri;
    }

}
