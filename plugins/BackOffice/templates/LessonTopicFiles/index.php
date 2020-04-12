<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopicFile[]|\Cake\Collection\CollectionInterface $lessonTopicFiles
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
    __('List Lesson Topic Files')
);

?>
<div class="row bo-index lessonTopicFiles">
    <?php if (!$lessonTopicFiles->count()): ?>
    <div class="col-12 mb-2">
        <div class="jumbotron text-center">
            <h1 class="display-4"><?= __('List Lesson Topic Files') ?></h1>
            <p class="lead">Kayıtlı bir veri bulamadık. Veri eklediğinizde burada görüntülenecektir.</p>
            <hr class="my-4">
            <p>Hemen bir tane oluşturmak için alttaki linke tıklayın.</p>
            <?= $this->Html->link(__('New Lesson Topic File'), [ 'action' => 'add', $lesson->id ], ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>
    <?php else: ?>
    <div class="col-12 mb-2">
        <div class="row">
            <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> <?= __('List Lesson Topic Files') ?></h4>
            <div class="col-6 bo-index-actions text-right">
                <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . __('New Lesson Topic File'), ['action' => 'add', $lesson->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card" style="min-height: 70vh;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lessonTopicFiles as $lessonTopicFile): ?>
                    <tr>
                        <td><?= $this->Number->format($lessonTopicFile->id) ?></td>
                        <td><?= $this->Html->link($lessonTopicFile->name, [ '_name' => 'bo_lesson_topic_file_show', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicFile->id ]) ?></td>
                        <td><?= h($lessonTopicFile->notes) ?></td>
                        <td><?= h($lessonTopicFile->created) ?></td>
                        <td class="actions">
                            <div class="btn-group btn-group-sm" role="group">
                                <?= $this->Html->link($this->BackOffice->icon('launch', 'md-16'), ['action' => 'view', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicFile->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Göster', 'data-toggle' => 'tooltip' ]) ?>
                                <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicFile->id], [ 'confirm' => __('{0} no`lu kayıt silinecek emin misiniz?', $lessonTopicFile->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
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
