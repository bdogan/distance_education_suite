<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopicVideo[]|\Cake\Collection\CollectionInterface $lessonTopicVideos
 * @var \App\Model\Entity\LessonTopic $lesson
 */

$this->Breadcrumbs->add(
    __('Dashboard'),
    [ '_name' => 'bo_home' ]
);
$this->Breadcrumbs->add(
    __('List Lesson Topics'),
    [ '_name' => 'bo_lesson_topics' ]
);
$this->Breadcrumbs->add(
    h($lesson->lesson) . ' - ' . h($lesson->subject),
    [ '_name' => 'bo_lesson_topic_view', $lesson->id ]
);
$this->Breadcrumbs->add(
    __('List Lesson Topic Videos')
);

?>
<div class="row bo-index lessonTopicVideos">
    <?php if (!$lessonTopicVideos->count()): ?>
    <div class="col-12 mb-2">
        <div class="jumbotron text-center">
            <h1 class="display-4"><?= __('Lesson Topic Videos') ?></h1>
            <p class="lead">Kayıtlı bir veri bulamadık. Veri eklediğinizde burada görüntülenecektir.</p>
            <hr class="my-4">
            <p>Hemen bir tane oluşturmak için alttaki linke tıklayın.</p>
            <?= $this->Html->link(__('New Lesson Topic Video'), [ 'action' => 'add', $lesson->id ], ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>
    <?php else: ?>
    <div class="col-12 mb-2">
        <div class="row">
            <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> <?= __('Lesson Topic Videos') ?></h4>
            <div class="col-6 bo-index-actions text-right">
                <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . __('New Lesson Topic Video'), ['action' => 'add', $lesson->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card" style="min-height: 70vh;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('app_alias', 'App') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('thumbnail') ?></th>
                        <th scope="col" style="width:70%"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('duration') ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lessonTopicVideos as $lessonTopicVideo): ?>
                <tr>
                    <td><?= $this->Number->format($lessonTopicVideo->id) ?></td>
                    <td><?= h($lessonTopicVideo->app_alias) ?></td>
                    <td><img style="height: 100px;" src="<?=$lessonTopicVideo->thumbnail?>" alt="<?=$lessonTopicVideo->name?>" /></td>
                    <td><?= h($lessonTopicVideo->name) ?></td>
                    <td>~<?= $this->Number->format($lessonTopicVideo->duration / 60, [ 'after' => 'dk', 'precision' => 0 ]) ?></td>
                    <td class="actions">
                        <div class="btn-group btn-group-sm" role="group">
                            <?= $this->Html->link($this->BackOffice->icon('launch', 'md-16'), ['action' => 'view', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Göster', 'data-toggle' => 'tooltip' ]) ?>
                            <?= $this->Html->link($this->BackOffice->icon('create', 'md-16'), ['action' => 'edit', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Düzenle', 'data-toggle' => 'tooltip' ]) ?>
                            <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id], [ 'confirm' => __('{0} no`lu kayıt silinecek emin misiniz?', $lessonTopicVideo->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
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
