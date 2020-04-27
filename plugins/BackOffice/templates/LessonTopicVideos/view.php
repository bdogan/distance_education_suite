<?php
/**
 * @var @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopicVideo $lessonTopicVideo
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
    __('List Lesson Topic Videos'),
    [ 'action' => 'index', $lesson->id ]
);
$this->Breadcrumbs->add(
    $lessonTopicVideo->name
);
?>

<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
                <?= $this->Html->link(__('Edit Lesson Topic Video'), ['action' => 'edit', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Form->postLink(
                __('Delete Lesson Topic Video'),
                ['action' => 'delete', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonTopicVideo->id), 'class' => 'list-group-item list-group-item-action border-top-0']
                ) ?>
                <?= $this->Html->link(__('List Lesson Topic Video'), [ 'action' => 'index', 'lesson_topic_id' => $lesson->id ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
                <?= $this->Html->link(__('New Lesson Topic Video'), [ 'action' => 'add', 'lesson_topic_id' => $lesson->id ], ['class' => 'list-group-item list-group-item-action']) ?>
            </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($lessonTopicVideo->name) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Class Room') ?></th>
                        <td><?= h($lesson->class_room->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Lesson Topic') ?></th>
                        <td><?= h($lesson->lesson) . ' - ' . h($lesson->subject) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('App') ?></th>
                        <td><?= h($lessonTopicVideo->app_alias) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Video Id') ?></th>
                        <td><?= h($lessonTopicVideo->video_id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($lessonTopicVideo->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Thumbnail') ?></th>
                        <td>
                            <img src="<?=$lessonTopicVideo->thumbnail?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><?= __('Duration') ?></th>
                        <td>~<?= $this->Number->format($lessonTopicVideo->duration / 60, [ 'after' => 'dk', 'precision' => 0 ]) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($lessonTopicVideo->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($lessonTopicVideo->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
