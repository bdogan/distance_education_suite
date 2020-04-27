<?php

namespace App\Controller;

use BackOffice\Lib\App;
use Cake\Http\Exception\UnauthorizedException;

/**
 * Class LessonTopicVideosController
 *
 * @package App\Controller
 * @property \App\Model\Table\LessonTopicVideosTable $LessonTopicVideos
 * @property \App\Model\Table\ConnectedAppsTable $ConnectedApps
 */
class LessonTopicVideosController extends AppController
{

    /**
     * @var string
     */
    public $modelClass = 'LessonTopicVideos';

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function show(string $lessonTopicId, string $id)
    {
        $this->request->allowMethod(['get']);
        $this->loadModel('ConnectedApps');

        $lessonTopicVideo = $this->LessonTopicVideos->get($id, [ 'contain' => [ 'LessonTopics' ] ]);
        if ($lessonTopicVideo->lesson_topic->id !== intval($lessonTopicId) || $lessonTopicVideo->lesson_topic->class_room_id !== $this->Authentication->getIdentityData('class_room_id')) throw new UnauthorizedException();

        /** @var \BackOffice\Lib\App $app */
        $app = $this->ConnectedApps->find('all', [ 'alias' => $lessonTopicVideo->app_alias, 'linked' => true, 'role' => App::ROLE_VIDEO_HOST ])->firstOrFail();

        return $app->video($this->request->withAttribute('video', $lessonTopicVideo), $this->response);
    }
}
