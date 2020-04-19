<?php
/**
 * @var \App\View\AppView $this
 */
?>
<header class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
    <div class="container-lg">

        <a class="navbar-brand" href="<?= $this->Url->build([ 'controller' => 'Pages', 'action' => 'home' ]); ?>" title="Selçuk Morkan Özel Öğretim Kursu">
            <?= $this->Html->image('logo.png'); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button">
                        Sınıflar
                    </a>
                </li>
                <li class="nav-item dropdown ml-sm-0 ml-md-4">
                    <a class="btn btn-light" href="#" role="button" data-toggle="dropdown">
                        <span class="material-icons-round md-18">account_box</span> <?= $this->Identity->get('user.name'); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= $this->Url->build([ 'controller' => 'Students', 'action' => 'logout' ]); ?>">Çıkış</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
