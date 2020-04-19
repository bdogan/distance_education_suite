<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface $student
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    __('List Students'),
    [ 'action' => 'index' ]
);
$this->Breadcrumbs->add(
    __('Edit Student')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Form->postLink(
               __('Delete'),
               ['action' => 'delete', $student->id],
               ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'list-group-item list-group-item-action border-top-0']
            ) ?>
            <?= $this->Html->link(__('List Students'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card students">
            <div class="card-header">
                <?= __('Edit Student') ?>
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
                ?>
                <div class="password-container" style="display: none;">
                    <?php
                        echo $this->Form->control('user.password', [ 'value' => '', 'class' => 'change_password', 'placeholder' => '•••••••', 'disabled' ]);
                    ?>
                </div>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <button type="button" data-role="change_password" class="btn btn-secondary mt-3"><?= __('Change Password') ?></button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
