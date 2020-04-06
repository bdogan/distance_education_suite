<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface $lessonTopic
 */

$this->Breadcrumbs->add(
    __('List Lesson Topics'),
    [ 'action' => 'index' ]
);
$this->Breadcrumbs->add(
    __('Edit Lesson Topic')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Form->postLink(
               __('Delete'),
               ['action' => 'delete', $lessonTopic->id],
               ['confirm' => __('Are you sure you want to delete # {0}?', $lessonTopic->id), 'class' => 'list-group-item list-group-item-action border-top-0']
            ) ?>
            <?= $this->Html->link(__('List Lesson Topics'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card lessonTopics">
            <div class="card-header">
                <?= __('Edit Lesson Topic') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($lessonTopic) ?>
                <?php
                    echo $this->Form->control('class_room_id');
                    echo $this->Form->control('lesson');
                    echo $this->Form->control('subject');
                    echo $this->Form->control('notes');
                ?>
                <?= $this->Form->button(__('Submit'), [ 'class' => 'btn btn-primary mt-3' ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
