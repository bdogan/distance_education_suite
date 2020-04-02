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
        <?= $this->AssetCompress->css('error.css'); ?>
    </head>
    <body>
        <div class="container-lg bo-main-container">
            <?= $this->fetch('content') ?>
        </div>
    </body>
</html>
