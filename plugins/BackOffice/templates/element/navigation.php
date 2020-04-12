<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 */
?>
<header class="navbar sticky-top navbar-expand-lg navbar-dark bo-navbar">
    <div class="container-lg">

        <a class="navbar-brand" href="<?= $this->Url->build([ '_name' => 'bo_home' ]); ?>" title="Distance Learning Suite">
            <?= $this->element('logo'); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto bo-main-menu">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Sınıflar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?= $this->Html->link('Liste', [ '_name' => 'bo_class_rooms' ], [ 'class' => 'dropdown-item' ]); ?>
                        <?= $this->Html->link('Yeni Ekle', [ '_name' => 'bo_class_room_add' ], [ 'class' => 'dropdown-item' ]); ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Öğrenciler
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?= $this->Html->link('Liste', [ '_name' => 'bo_students' ], [ 'class' => 'dropdown-item' ]); ?>
                        <?= $this->Html->link('Yeni Ekle', [ '_name' => 'bo_student_add' ], [ 'class' => 'dropdown-item' ]); ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Dersler
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?= $this->Html->link('Liste', [ '_name' => 'bo_lesson_topics' ], [ 'class' => 'dropdown-item' ]); ?>
                        <?= $this->Html->link('Yeni Ekle', [ '_name' => 'bo_lesson_topic_add' ], [ 'class' => 'dropdown-item' ]); ?>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        <?= $this->BackOffice->icon('person','md-18 d-none d-lg-inline-block') . ' ' . $this->Identity->get('name'); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= $this->Url->build([ '_name' => 'bo_profile' ]); ?>"><?= $this->BackOffice->icon('account_circle', 'md-18') ?> Hesabım</a>
                        <a class="dropdown-item" href="<?= $this->Url->build([ '_name' => 'bo_change_password' ]); ?>"><?= $this->BackOffice->icon('lock', 'md-18') ?> Şifre Değiştir</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $this->Url->build([ '_name' => 'bo_connected_apps' ]); ?>"><?= $this->BackOffice->icon('apps', 'md-18') ?> Bağlı Uygulamalar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $this->Url->build([ '_name' => 'bo_logout' ]); ?>"><?= $this->BackOffice->icon('exit_to_app', 'md-18') ?> Çıkış</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
