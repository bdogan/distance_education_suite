<?php

namespace BackOffice\View;

use Cake\View\View;

/**
 * Class BackOfficeView
 *
 * @package BackOffice\View
 *
 * @property \AssetCompress\View\Helper\AssetCompressHelper $AssetCompress
 * @property \Authentication\View\Helper\IdentityHelper $Identity
 * @property \BackOffice\View\Helper\FormHelper $Form
 * @property \BackOffice\View\Helper\BackOfficeHelper $BackOffice
 */
class BackOfficeView extends View
{

    public function initialize(): void
    {
        $this->loadHelper('AssetCompress.AssetCompress');
        $this->loadHelper('Authentication.Identity');
        $this->loadHelper('BackOffice.Form');
        $this->loadHelper('BackOffice.BackOffice');
        $this->loadHelper('Html');
        $this->loadHelper('Url');
        $this->loadHelper('Flash');
    }

}
