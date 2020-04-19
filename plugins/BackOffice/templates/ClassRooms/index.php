<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $classRooms
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    'Sınıflar'
);
?>
<div class="row bo-index classRooms">
    <?php if (!$classRooms->count()): ?>
        <div class="col-12 mb-2">
            <div class="jumbotron text-center">
                <h1 class="display-4">Sınıf Listesi</h1>
                <p class="lead">Kayıtlı bir veri bulamadık. Veri eklediğinizde burada görüntülenecektir.</p>
                <hr class="my-4">
                <p>Hemen bir tane oluşturmak için alttaki linke tıklayın.</p>
                <?= $this->Html->link('Oluştur', ['action' => 'add'], ['class' => 'btn btn-lg btn-primary', 'escape' => false]) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="col-12 mb-2">
            <div class="row">
                <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> Sınıf Listesi</h4>
                <div class="col-6 bo-index-actions text-right">
                    <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . 'Yeni Sınıf', ['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card" style="min-height: 70vh;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 46px"><?= $this->Paginator->sort('id', '#') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name', 'Adı') ?></th>
                            <th scope="col" style="width: 150px"><?= $this->Paginator->sort('created', 'Oluşturma') ?></th>
                            <th scope="col" style="width: 150px"><?= $this->Paginator->sort('modified', 'Düzenleme') ?></th>
                            <th scope="col" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($classRooms as $classRoom): ?>
                        <tr>
                            <td><?= $this->Number->format($classRoom->id) ?></td>
                            <td><?= h($classRoom->name) ?></td>
                            <td><?= h($classRoom->created) ?></td>
                            <td><?= h($classRoom->modified) ?></td>
                            <td class="actions">
                                <div class="btn-group btn-group-sm" role="group">
                                    <?= $this->Html->link($this->BackOffice->icon('launch', 'md-16'), ['action' => 'view', $classRoom->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Göster', 'data-toggle' => 'tooltip' ]) ?>
                                    <?= $this->Html->link($this->BackOffice->icon('create', 'md-16'), ['action' => 'edit', $classRoom->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Düzenle', 'data-toggle' => 'tooltip' ]) ?>
                                    <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', $classRoom->id], [ 'confirm' => __('{0} no`lu kayıt silinecek emin misiniz?', $classRoom->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
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
