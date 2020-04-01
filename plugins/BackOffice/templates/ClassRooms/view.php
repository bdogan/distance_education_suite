<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $classRoom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Class Room'), ['action' => 'edit', $classRoom->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Class Room'), ['action' => 'delete', $classRoom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classRoom->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Class Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Class Room'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="classRooms view content">
            <h3><?= h($classRoom->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($classRoom->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($classRoom->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($classRoom->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($classRoom->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
