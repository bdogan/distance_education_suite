<?php

namespace BackOffice\Lib;

use BackOffice\Lib\App\VimeoApp;
use Cake\Collection\Collection;

class AppCollection extends Collection
{

    /**
     * AppCollection constructor.
     *
     * @param iterable $items
     */
    public function __construct()
    {
        parent::__construct([
            new VimeoApp()
        ]);
    }

}
