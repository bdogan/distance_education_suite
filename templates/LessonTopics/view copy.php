<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonTopic $lessonTopic
 */
?>
<div class="row mt-3">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=$this->Url->build([ 'controller' => 'Pages', 'action' => 'home' ])?>">Ana Sayfa</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?=$lessonTopic->lesson . ' - ' . $lessonTopic->subject?></li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="<?=$lessonTopic->lesson_topic_files ? 'col-8' : 'col-12' ?>">
                <?php if (!!$lessonTopic->notes): ?>
                <div class="card mb-3">
                    <div class="card-header"><span class="material-icons-round md-18">event_note</span> Ders Notları</div>
                    <div class="card-body">
                        <?=$lessonTopic->notes?>
                    </div>
                </div>
                <?php endif; ?>
                <?php
                /** @var \App\Model\Entity\LessonTopicVideo $lessonTopicVideo */
                foreach ($lessonTopic->lesson_topic_videos as $lessonTopicVideo):
                ?>
                    <div class="card mb-3">
                        <div class="card-header"><span class="material-icons-round md-18">videocam</span> <?=$lessonTopicVideo->name?></div>
                        <div class="video-container d-flex flex-column justify-content-center" style="min-height: 200px" data-video-id="<?=$this->Url->build([ 'controller' => 'LessonTopicVideos', 'action' => 'show', 'lessonTopicId' => $lessonTopic->id, 'id' => $lessonTopicVideo->id ])?>" data-app="<?=$lessonTopicVideo->app_alias?>">
                            <p class="text-primary text-center"><span class="spinner-border spinner-border-sm" role="status"></span>  Lütfen Bekleyin</p>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
            <div class="col-4">
                <?php if ($lessonTopic->lesson_topic_files): ?>
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <div><span class="material-icons-round md-18">file_copy</span> Ders Dosyaları</div>
                        <span class="badge badge-primary badge-pill"><?=count($lessonTopic->lesson_topic_files)?></span>
                    </div>
                    <div class="list-group list-group-flush" style="min-height: 80px">
                        <?php
                        /** @var \App\Model\Entity\LessonTopicFile $lesson_topic_file */
                        foreach ($lessonTopic->lesson_topic_files as $lessonTopicFile):
                        ?>
                            <a target="_blank" href="<?=$this->Url->build([ 'controller' => 'LessonTopicFiles', 'action' => 'show', 'lessonTopicId' => $lessonTopic->id, 'id' => $lessonTopicFile->id ]);?>" class="list-group-item">
                                <h5 class="mb-1"><?=h($lessonTopicFile->name)?></h5>
                                <p class="mb-1"><?=h($lessonTopicFile->notes)?></p>
                            </a>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
