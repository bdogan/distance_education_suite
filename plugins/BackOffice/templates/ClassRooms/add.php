<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $classRoom
 */

$this->Breadcrumbs->add(
    'Sınıflar',
    [ '_name' => 'bo_class_rooms' ]
);
$this->Breadcrumbs->add(
    'Yeni Sınıf'
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('List Class Rooms'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= __('Add Class Room') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($classRoom) ?>
                <?= $this->Form->control('name'); ?>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
