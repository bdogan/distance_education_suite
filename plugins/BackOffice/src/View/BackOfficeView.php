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
        $this->loadHelper('Paginator', [
            'templates' => [
                'nextActive' => '<li class="page-item has-icon"><a class="page-link" rel="next" href="{{url}}"><i class="material-icons-round md-18">chevron_right</i></a></li>',
                'nextDisabled' => '<li class="page-item disabled has-icon"><a class="page-link" href="" onclick="return false;"><i class="material-icons-round md-18">chevron_right</i></a></li>',
                'prevActive' => '<li class="page-item has-icon"><a class="page-link" rel="prev" href="{{url}}"><i class="material-icons-round md-18">chevron_left</i></a></li>',
                'prevDisabled' => '<li class="page-item disabled has-icon"><a class="page-link" href="" onclick="return false;"><i class="material-icons-round md-18">chevron_left</i></a></li>',
                'counterRange' => '{{start}} - {{end}} of {{count}}',
                'counterPages' => '{{page}} of {{pages}}',
                'first' => '<li class="page-item has-icon"><a class="page-link" href="{{url}}"><i class="material-icons-round md-18">first_page</i></a></li>',
                'last' => '<li class="page-item has-icon"><a class="page-link" href="{{url}}"><i class="material-icons-round md-18">last_page</i></a></li>',
                'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
                'ellipsis' => '<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>',
                'sort' => '<a href="{{url}}">{{text}}</a>',
                'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
                'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
                'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
                'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
            ]
        ]);
        $this->loadHelper('Breadcrumbs', [
            'templates' => [
                'wrapper' => '<ol class="breadcrumb">{{content}}</ol>',
                'item' => '<li class="breadcrumb-item"><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
                'itemWithoutLink' => '<li class="breadcrumb-item active">{{title}}</li>{{separator}}',
                'separator' => '',
            ]
        ]);
        $this->loadHelper('Html');
        $this->loadHelper('Url');
        $this->loadHelper('Flash');
    }

}
