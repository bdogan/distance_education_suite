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
    $classRoom->name
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('Edit Class Room'), ['action' => 'edit', $classRoom->id], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $classRoom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $classRoom->id), 'class' => 'list-group-item list-group-item-action border-top-0']
            ) ?>
            <?= $this->Html->link(__('List Class Rooms'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
            <?= $this->Html->link(__('New Class Room'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($classRoom->name) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($classRoom->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($classRoom->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($classRoom->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($classRoom->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
