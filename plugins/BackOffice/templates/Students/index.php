<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    __('Students')
);
?>
<div class="row bo-index students">
    <?php if (!$students->count()): ?>
    <div class="col-12 mb-2">
        <div class="jumbotron text-center">
            <h1 class="display-4"><?= __('Students') ?></h1>
            <p class="lead">Kayıtlı bir veri bulamadık. Veri eklediğinizde burada görüntülenecektir.</p>
            <hr class="my-4">
            <p>Hemen bir tane oluşturmak için alttaki linke tıklayın.</p>
            <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>
    <?php else: ?>
    <div class="col-12 mb-2">
        <div class="row">
            <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> <?= __('Students') ?></h4>
            <div class="col-6 bo-index-actions text-right">
                <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . __('New Student'), ['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card" style="min-height: 70vh;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Users.name', 'Name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('ClassRooms.name', 'Class Room') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Users.email', 'Email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $this->Number->format($student->id) ?></td>
                    <td><?= h($student->user->name) ?></td>
                    <td><?= h($student->class_room->name) ?></td>
                    <td><?= h($student->user->email) ?></td>
                    <td><?= h($student->created) ?></td>
                    <td><?= h($student->modified) ?></td>
                    <td class="actions">
                        <div class="btn-group btn-group-sm" role="group">
                            <?= $this->Html->link($this->BackOffice->icon('launch', 'md-16'), ['action' => 'view', $student->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Göster', 'data-toggle' => 'tooltip' ]) ?>
                            <?= $this->Html->link($this->BackOffice->icon('create', 'md-16'), ['action' => 'edit', $student->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Düzenle', 'data-toggle' => 'tooltip' ]) ?>
                            <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', $student->id], [ 'confirm' => __('{0} no`lu kayıt silinecek emin misiniz?', $student->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12">
        <div class="row align-items-baseline">
            <div class="col-sm-5 text-muted small d-none d-md-block">
                <?= $this->Paginator->counter(__('{{count}} kayıt arasından {{current}} kayıt gösteriliyor. Sayfa {{page}} / {{pages}}')) ?>
            </div>
            <div class="col-md-7">
                <ul class="pagination justify-content-end">
                    <?= $this->Paginator->first('<< ' . __('first'), [ 'class' => 'page-item' ]) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
