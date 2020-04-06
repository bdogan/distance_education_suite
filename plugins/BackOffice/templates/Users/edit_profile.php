<?php
/**
 * @var @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\User $user
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    __('Profile'),
    [ '_name' => 'bo_profile' ]
);
$this->Breadcrumbs->add(
    __('Edit Profile')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('View Profile'), [ '_name' => 'bo_profile' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
            <?= $this->Html->link(__('Change Password'), [ '_name' => 'bo_change_password' ], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card lessonTopics">
            <div class="card-header">
                <?= __('Change Password') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user) ?>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                ?>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
