<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface $student
 */

$this->Breadcrumbs->add(
    __('List Students'),
    [ 'action' => 'index' ]
);
$this->Breadcrumbs->add(
    __('Add Student')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('List Students'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card students">
            <div class="card-header">
                <?= __('Add Student') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($student, [
                    'context' => [
                        'validator' => [
                            'Users' => 'student'
                        ]
                    ]
                ]) ?>
                <?php
                    echo $this->Form->hidden('user_id');
                    echo $this->Form->control('user.name');
                    echo $this->Form->control('user.email');
                    echo $this->Form->control('class_room_id');
                    echo $this->Form->control('tc_kimlik');
                    echo $this->Form->control('user.password');
                ?>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
