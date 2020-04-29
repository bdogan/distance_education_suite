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
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach ($lessonTopic->lesson_topic_videos as $index => $lessonTopicVideo): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $index === 0 ? 'active' : ''?>" data-alias="vimeo" id="video-<?=$index?>-tab" data-toggle="tab" href="#video-<?=$index?>-pane">
                                <span class="material-icons-round md-18">videocam</span> Video <?=$index + 1?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($lessonTopic->lesson_topic_videos as $index => $lessonTopicVideo): ?>
                        <div class="tab-pane fade <?= $index === 0 ? 'show active' : ''?>" id="video-<?=$index?>-pane" role="tabpanel" style="min-height: 20vh;">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <div class="video-container d-flex flex-column justify-content-center" style="min-height: 200px; border-radius: 3px; overflow: hidden;" data-info-target="#video-<?=$index?>-info" data-video-id="<?=$this->Url->build([ 'controller' => 'LessonTopicVideos', 'action' => 'show', 'lessonTopicId' => $lessonTopic->id, 'id' => $lessonTopicVideo->id ])?>" data-app="<?=$lessonTopicVideo->app_alias?>">
                                        <p class="text-primary text-center"><span class="spinner-border spinner-border-sm" role="status"></span>  Lütfen Bekleyin</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="alert alert-info fade" role="alert" id="video-<?=$index?>-info">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
				<?php if (!!$lessonTopic->notes): ?>
                    <div class="card mb-3">
                        <div class="card-header"><span class="material-icons-round md-18">event_note</span> Ders Notları</div>
                        <div class="card-body">
                            <?=$lessonTopic->notes?>
                        </div>
                    </div>
                <?php endif; ?>
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
