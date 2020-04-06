<?php
/**
 * @var @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopicFile $lessonTopicFile
 * @var \App\Model\Entity\LessonTopic $lesson
 */

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
    $lessonTopicFile->name
);
?>

<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
                <?= $this->Form->postLink(
                __('Delete Lesson Topic File'),
                ['action' => 'delete', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicFile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonTopicFile->id), 'class' => 'list-group-item list-group-item-action border-top-0']
                ) ?>
                <?= $this->Html->link(__('List Lesson Topic File'), [ 'action' => 'index', $lesson->id ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
                <?= $this->Html->link(__('New Lesson Topic File'), [ 'action' => 'add', $lesson->id ], ['class' => 'list-group-item list-group-item-action']) ?>
            </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($lessonTopicFile->name) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($lessonTopicFile->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Lesson Topic') ?></th>
                        <td><?= h($lesson->lesson) . ' - ' . h($lesson->subject) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Class Room') ?></th>
                        <td><?= h($lesson->class_room->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= $this->Html->link( $lessonTopicFile->name, [ '_name'           => 'bo_lesson_topic_file_show',
                                                                             'lesson_topic_id' => $lesson->id,
                                                                             'id'              => $lessonTopicFile->id
                            ] ); ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Type') ?></th>
                        <td><?= h($lessonTopicFile->type) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Notes') ?></th>
                        <td><?= h($lessonTopicFile->notes) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Size') ?></th>
                        <td><?= $this->Number->format($lessonTopicFile->size) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($lessonTopicFile->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($lessonTopicFile->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
