<?php
/**
 * @var @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopic $lessonTopic
 */

$this->Breadcrumbs->add(
    __('List Lesson Topics'),
    [ 'action' => 'index' ]
);
$this->Breadcrumbs->add(
    h($lessonTopic->lesson) . ' - ' . h($lessonTopic->subject)
);
?>

<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
                <?= $this->Html->link(__('Edit Lesson Topic'), ['action' => 'edit', $lessonTopic->id], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Form->postLink(
                __('Delete Lesson Topic'),
                ['action' => 'delete', $lessonTopic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonTopic->id), 'class' => 'list-group-item list-group-item-action border-top-0']
                ) ?>
                <?= $this->Html->link(__('List Lesson Topic'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
                <?= $this->Html->link(__('New Lesson Topic'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('Files ({0})', count($lessonTopic->lesson_topic_files)), [ '_name' => 'bo_lesson_topic_files', 'lesson_topic_id' => $lessonTopic->id ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
            </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card">
            <div class="card-header">
                <?= h($lessonTopic->lesson) . ' - ' . h($lessonTopic->subject) ?>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($lessonTopic->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Lesson') ?></th>
                        <td><?= h($lessonTopic->lesson) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Subject') ?></th>
                        <td><?= h($lessonTopic->subject) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Class Room') ?></th>
                        <td><?= h($lessonTopic->class_room->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($lessonTopic->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($lessonTopic->modified) ?></td>
                    </tr>
                </table>
                <div class="text">
                    <strong><?= __('Notes') ?></strong>
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($lessonTopic->notes)); ?>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
