<?php
/**
 * @var @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\Student $student
 */

$this->Breadcrumbs->add(
    __('List Students'),
    [ 'action' => 'index' ]
);
$this->Breadcrumbs->add(
    h($student->user->name)
);
?>

<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Form->postLink(
            __('Delete Student'),
            ['action' => 'delete', $student->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'list-group-item list-group-item-action border-top-0']
            ) ?>
            <?= $this->Html->link(__('List Student'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
            <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                    </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($student->user->name) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($student->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($student->user->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Class Room') ?></th>
                        <td><?= h($student->class_room->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($student->user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($student->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($student->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
