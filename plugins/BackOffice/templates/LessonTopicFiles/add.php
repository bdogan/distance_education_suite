<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface $lessonTopicFile
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
    __('List Lesson Topic Files'),
    [ 'action' => 'index', $lesson->id ]
);
$this->Breadcrumbs->add(
    __('Add Lesson Topic File')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('List Lesson Topic Files'), [ 'action' => 'index', $lesson->id ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card lessonTopicFiles">
            <div class="card-header">
                <?= __('Add Lesson Topic File') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($lessonTopicFile, ['enctype' => 'multipart/form-data']) ?>
                <?php
                    echo $this->Form->control('_file', [ 'type' => 'file', 'label' => 'Dosya (pdf/jpeg/png)' ]);
                    echo $this->Form->control('notes');
                ?>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
