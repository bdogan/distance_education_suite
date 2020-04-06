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
    __('Profile')
);
?>

<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('Change Password'), [ '_name' => 'bo_change_password' ], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Edit Profile'), [ '_name' => 'bo_profile_edit' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($user->name) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($user->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Type') ?></th>
                        <td><?= h($user->type) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($user->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($user->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
