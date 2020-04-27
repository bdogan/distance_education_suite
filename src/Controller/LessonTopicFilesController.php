<?php

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;

/**
 * Class LessonTopicFilesController
 *
 * @package App\Controller
 * @property \App\Model\Table\LessonTopicFilesTable $LessonTopicFiles
 */
class LessonTopicFilesController extends AppController
{

    /**
     * @var string
     */
    public $modelClass = 'LessonTopicFiles';

    /**
     * @param string $lessonTopicId
     * @param string $id
     *
     * @return \Cake\Http\Response
     */
    public function show(string $lessonTopicId, string $id)
    {
        $this->request->allowMethod(['get']);

        $lessonTopicFile = $this->LessonTopicFiles->get($id, [ 'contain' => [ 'LessonTopics' ] ]);
        if ($lessonTopicFile->lesson_topic->id !== intval($lessonTopicId) || $lessonTopicFile->lesson_topic->class_room_id !== $this->Authentication->getIdentityData('class_room_id')) throw new UnauthorizedException();

        return $this->response->withFile(UPLOAD_PATH . $lessonTopicFile->name);
    }

}
