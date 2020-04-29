<?php
/**
 * Default layout
 *
 * @var \BackOffice\View\BackOfficeView $this
 */
?>
<!doctype html>
<html lang="tr">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->fetch('title')?></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <script>eval(atob("<?=base64_encode("(function(w){ w.CSRF_TOKEN='" . $this->request->getAttribute('csrfToken') . "'; })(window)")?>"));</script>
        <?= $this->AssetCompress->css('style.css'); ?>
        <?= $this->Html->css('../yeni');?>
        <?= $this->AssetCompress->script('app.js', [ 'defer' => true ]); ?>
    </head>
    <body>
        <?= $this->element('navigation'); ?>
        <div class="container-lg">
            <?= $this->element('breadcrumbs'); ?>
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content') ?>
        </div>
    </body>
</html>
