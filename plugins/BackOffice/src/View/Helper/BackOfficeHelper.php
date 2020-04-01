<?php
declare(strict_types=1);

namespace BackOffice\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\View\View;

/**
 * BackOffice helper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class BackOfficeHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @var array
     */
    protected $helpers = [ 'Html' ];

    /**
     * @var \BackOffice\Plugin
     */
    public $BackOffice;

    /**
     * @param array $config
     */
    public function initialize( array $config ): void
    {
        parent::initialize( $config );
        $this->BackOffice = Configure::read('BackOffice');
    }

    /**
     * @param string|null $key
     * @param null $default
     *
     * @return mixed
     */
    public function getConfig( ?string $key = null, $default = null )
    {
        return $this->BackOffice->getConfig($key, $default);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getPage($name)
    {
        return $this->BackOffice->getPage($name);
    }

    public function getRoute($name)
    {
        return $this->BackOffice->getRoute($name);
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->BackOffice->getPages();
    }

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        return $this->BackOffice->getHomePage();
    }

    /**
     * @return string
     */
    public function getHomeRoute()
    {
        return $this->BackOffice->getHomeRoute();
    }

    /**
     * @param string $name
     * @param string|null $class
     *
     * @return string
     */
    public function icon(string $name, string $class = null)
    {
        $_class = 'material-icons-round';
        if ($class) $_class .= ' ' . $class;
        return $this->Html->tag('i', $name, [ 'class' => $_class ]);
    }
}
