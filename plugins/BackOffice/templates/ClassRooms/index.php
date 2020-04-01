<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $classRooms
 */
?>
<div class="row bo-index classRooms">
    <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> Sınıf Listesi</h4>
    <div class="col-6 bo-index-actions text-right">
        <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . 'Yeni Sınıf', ['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
    </div>
    <div class="col-12">
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
                            <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', $classRoom->id], [ 'confirm' => __('Are you sure you want to delete # {0}?', $classRoom->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-12">

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>
