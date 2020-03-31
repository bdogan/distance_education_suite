<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 */
?>
<header class="navbar sticky-top navbar-expand-lg bo-navbar">
    <div class="container-lg">

        <a class="navbar-brand" href="<?= $this->Url->build([ '_name' => 'bo_home' ]); ?>" title="Distance Learning Suite">
            <?= $this->element('logo'); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Sınıflar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Öğrenciler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dersler</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        <?= $this->BackOffice->icon('account_circle','md-24') . $this->Identity->get('name'); ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $this->Url->build([ '_name' => 'bo_logout' ]); ?>">Çıkış</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
