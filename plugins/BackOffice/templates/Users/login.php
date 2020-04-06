<?php
/**
 * Default layout
 *
 * @var \BackOffice\View\BackOfficeView $this
 */

$this->disableAutoLayout();
?>
<!doctype html>
<html lang="tr">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->fetch('title')?></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?= $this->AssetCompress->css('BackOffice.backoffice_style.css'); ?>
        <?= $this->AssetCompress->script('BackOffice.backoffice_app.js', [ 'defer' => true ]); ?>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row bo-login-container">
                <div class="card m-auto">
                    <div class="card-body">
                        <?= $this->element('logo', [ 'class' => 'bo-login' ]); ?>
                        <h4 class="card-title">Giriş Yapınız</h4>
                        <?= $this->Flash->render(); ?>
                        <?= $this->Form->create(); ?>
                            <?= $this->Form->control('email', [ 'type' => 'email', 'label' => false, 'placeholder' => 'E-posta', 'container' => [ 'class' => 'mb-3' ] ]) ?>
                            <?= $this->Form->control('password', [ 'type' => 'password', 'label' => false, 'placeholder' => 'Şifre', 'container' => [ 'class' => 'mb-3' ] ]) ?>
                            <?= $this->Form->control('remember_me', [ 'type' => 'checkbox', 'label' => 'Beni hatırla' ]) ?>
                            <div class="d-flex justify-content-end">
                                <?= $this->Form->button(__('Giriş'), [ 'class' => 'btn btn-primary' ]); ?>
                            </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
