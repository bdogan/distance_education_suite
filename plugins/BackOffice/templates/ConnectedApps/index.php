<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 * @var \BackOffice\Lib\App[] $connectedApps
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    __('Connected Apps')
);
?>
<div class="row">
    <div class="col-12 d-flex flex-wrap">
        <?php foreach ($connectedApps as $connectedApp): ?>
            <div class="card <?=$connectedApp->alias?>" style="width: 18rem;">
                <?=$connectedApp->getLogo($this->Html, [ 'class' => 'card-image-top', 'style' => 'padding: 10px 22px; background-color: #EEF1F2;' ])?>
                <div class="card-body">
                    <h5 class="card-title"><?=$connectedApp->name?></h5>
                    <p class="card-text overflow-hidden"><?=$connectedApp->description?></p>
                    <?php if (!$connectedApp->ConnectedApp) { ?>
                        <a href="<?=$this->Url->build([ '_name' => 'bo_app_connect', 'alias' => $connectedApp->alias ])?>" class="btn btn-primary">Bağla</a>
                    <?php } else { ?>
                        <div class="d-sm-flex flex-column align-items-start">
                            <span class="badge badge-success mb-2"><?=$connectedApp->ConnectedApp->user_formatted['name']?></span>
                            <a href="<?=$this->Url->build([ '_name' => 'bo_app_disconnect', 'alias' => $connectedApp->alias ])?>" class="btn btn-danger">Kaldır</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
