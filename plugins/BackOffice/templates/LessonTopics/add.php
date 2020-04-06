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
    __('Add Lesson Topic')
);
?>
<div class="row">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Html->link(__('List Lesson Topics'), [ 'action' => 'index' ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card lessonTopics">
            <div class="card-header">
                <?= __('Add Lesson Topic') ?>
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
