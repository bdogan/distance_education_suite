<?php
/**
 * Default layout
 *
 * @var \App\View\AppView $this
 * @var \Cake\ORM\Query $lessonTopics
 */

$lessons = $lessonTopics->order([ 'lesson ASC', 'subject ASC' ])->indexBy('lesson')->map(function ($l) { return $l->lesson; });
$cursor = 0;
?>
<div class="row mt-3">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            <?php foreach ($lessons as $key => $lesson): ?>
                <?php
                    $_lessonTopics = $lessonTopics->filter(function ($l) use ($lesson) { return $l->lesson === $lesson; });
                    if (!$_lessonTopics->count()) continue;
                ?>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#lesson_topics_<?=$key?>" aria-expanded="true" aria-controls="lesson_topics_<?=$key?>">
                                <?=$lesson?> (<?=$_lessonTopics->count()?>)
                            </button>
                        </h2>
                    </div>
                    <div id="lesson_topics_<?=$key?>" class="collapse <?=$cursor === 0 ? 'show' : ''?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <?php
                                    /** @var \App\Model\Entity\LessonTopic $lessonTopic */
                                    foreach ($_lessonTopics as $lessonTopic):
                                ?>
                                    <a href="<?=$this->Url->build([ 'controller' => 'LessonTopics', 'action' => 'view', $lessonTopic->id ]);?>" class="list-group-item list-group-item-action">
                                        <?=$lessonTopic->subject?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $cursor++;
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
