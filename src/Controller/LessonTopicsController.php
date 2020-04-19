<?php

namespace App\Controller;

/**
 * Class LessonTopicsController
 *
 * @package App\Controller
 * @property \App\Model\Table\LessonTopicsTable $LessonTopics
 */
class LessonTopicsController extends AppController
{

    /**
     * @var string
     */
    public $modelClass = 'LessonTopics';

    /**
     * @param string $id
     */
    public function view(string $id)
    {
        $lessonTopic = $this->LessonTopics->get($id, [ 'contain' => [ 'LessonTopicFiles', 'LessonTopicVideos' ] ]);

        $this->set(compact('lessonTopic'));
    }
}
