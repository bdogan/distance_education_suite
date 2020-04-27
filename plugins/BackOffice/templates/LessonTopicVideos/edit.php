<?php
/**
 * @var \Backoffice\View\BackOfficeView $this
 * @var \App\Model\Entity\LessonTopicVideo $lessonTopicVideo
 * @var \App\Model\Entity\LessonTopic $lesson
 * @var \BackOffice\Lib\App[] $apps
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
    __('List Lesson Topic Videos'),
    [ 'action' => 'index', $lesson->id ]
);
$this->Breadcrumbs->add(
    $lessonTopicVideo->name
);
?>
<script>const selectedVideo = JSON.parse(atob("<?=base64_encode(json_encode($lessonTopicVideo))?>"))</script>
<div class="row video-selector mb-5">
    <aside class="col-md-3">
        <div class="list-group">
            <div class="list-group-item list-group-item-success"><?= __('Actions') ?></div>
            <?= $this->Form->postLink(
               __('Delete'),
               ['action' => 'delete', 'lesson_topic_id' => $lesson->id, 'id' => $lessonTopicVideo->id],
               ['confirm' => __('Are you sure you want to delete # {0}?', $lessonTopicVideo->id), 'class' => 'list-group-item list-group-item-action border-top-0']
            ) ?>
            <?= $this->Html->link(__('List Lesson Topic Videos'), [ 'action' => 'index', $lesson->id ], [ 'class' => 'list-group-item list-group-item-action' ]) ?>
        </div>
    </aside>
    <div class="col mt-2 mt-md-0">
        <div class="card lessonTopicVideos">
            <div class="card-header">
                <?= __('Edit Lesson Topic Video') ?>
            </div>
            <div class="card-body">
                <?= $this->Form->create($lessonTopicVideo) ?>
                <div class="card" id="selected_video">
                    <div class="card-header" v-bind:class="{ 'bg-danger text-white': !selectedVideo, 'bg-success text-white': selectedVideo }">
                        {{ selectedVideo ? selectedVideo.name : 'Seçili video yok' }}
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between align-items-end">
                        <div class="container-fluid p-0" style="min-height: 140px">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <svg v-if="!selectedVideo" class="figure-img img-fluid rounded" width="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#e2e2e2"></rect></svg>
                                    <img v-if="selectedVideo" class="img-thumbnail" v-bind:src="selectedVideo.thumbnail" v-bind:alt="selectedVideo.name" />
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <svg v-if="!selectedVideo" class="figure-img img-fluid rounded" style="height: 94px" width="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#e2e2e2"></rect></svg>
                                    <template v-if="selectedVideo">
                                        <h3 class="card-text">{{selectedVideo.name}}</h3>
                                        <p class="card-text text-muted">{{ (selectedVideo.duration / 60).toFixed() }}dk</p>
                                    </template>
                                    <?php
                                        echo $this->Form->button(__('Submit'), [ 'class' => 'btn btn-success mt-3', ':disabled' => '!selectedVideo' ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo $this->Form->hidden('app_alias', [ 'v-bind:value' => 'getSelectedVideo.app_alias || null' ]);
                        echo $this->Form->hidden('video_id', [ 'v-bind:value' => 'getSelectedVideo.video_id' ]);
                        echo $this->Form->hidden('name', [ 'v-bind:value' => 'getSelectedVideo.name' ]);
                        echo $this->Form->hidden('duration', [ 'v-bind:value' => 'getSelectedVideo.duration' ]);
                        echo $this->Form->hidden('thumbnail', [ 'v-bind:value' => 'getSelectedVideo.thumbnail' ]);
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <ul class="nav nav-tabs mt-3" role="tablist">
                    <?php foreach ($apps as $app): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-alias="<?=$app->alias?>" id="<?=$app->alias?>-tab" data-toggle="tab" href="#<?=$app->alias?>">
                                <?=$app->name?>
                                <div class="spinner-border spinner-border-sm" style="display: none;" role="status"></div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($apps as $app): ?>
                        <div class="tab-pane fade" id="<?=$app->alias?>" role="tabpanel" style="min-height: 50vh;">
                            <div class="row">
                                <div v-for="video of videos" class="col-md-6 col-xl-4 mt-3 d-flex">
                                    <div class="card">
                                        <img style="min-height: 120px;" v-bind:src="video.thumbnail" v-bind:alt="video.name" />
                                        <div class="card-body d-flex flex-column justify-content-between align-items-start">
                                            <p class="card-text">{{video.name}}</p>
                                            <div class="flex-grow-1"></div>
                                            <p class="card-text text-muted small">
                                                <span class="badge badge-light">{{ (video.duration / 60).toFixed() }}dk</span>
                                            </p>
                                            <button class="btn btn-outline-primary" v-on:click="selectVideo(video)" :disabled="selectedVideo && video.video_id === selectedVideo.video_id">{{ selectedVideo && video.video_id === selectedVideo.video_id ? 'Seçili' : 'Seç' }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="videos && hasMore" class="col-12 mt-3 text-center">
                                    <button type="button" class="btn btn-dark" :disabled="loading" v-on:click="loadVideos()">
                                        <span v-if="loading" class="spinner-border spinner-border-sm" role="status"></span>
                                        Daha fazla yükle
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
