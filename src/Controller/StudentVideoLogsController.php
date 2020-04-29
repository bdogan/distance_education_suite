<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\StudentVideoLog;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;

/**
 * StudentVideoLogs Controller
 *
 * @property \App\Model\Table\StudentVideoLogsTable $StudentVideoLogs
 *
 *
 */
class StudentVideoLogsController extends AppController
{

    /**
     * @var string Model Class
     */
    public $modelClass = 'StudentVideoLogs';

    /**
     * @param null $lesson_topic_video_id
     * @param null $event
     *
     * @return \Cake\Http\Response
     */
    public function write($lesson_topic_id = null, $lesson_topic_video_id = null, $event = null)
    {
        // Get lesson topic video
        $lessonTopicVideo = $this->StudentVideoLogs->LessonTopicVideos->get($lesson_topic_video_id, [ 'contain' => 'LessonTopics' ]);
        if ($lessonTopicVideo->lesson_topic_id != $lesson_topic_id || $lessonTopicVideo->lesson_topic->class_room_id != $this->Authentication->getIdentityData('class_room_id')) {
            throw new NotFoundException();
        }

        // Create & Update log
        $studentVideoLog = $this->StudentVideoLogs->find()->where([ 'lesson_topic_video_id' => $lesson_topic_video_id, 'event' => $event, 'student_id' => $this->Authentication->getIdentityData('id') ])->first();
        $studentVideoLog = $studentVideoLog ?? new StudentVideoLog();
        $this->StudentVideoLogs->patchEntity($studentVideoLog, [
            'lesson_topic_video_id' => $lessonTopicVideo->id,
            'student_id' => $this->Authentication->getIdentityData('id'),
            'context' => json_encode(empty($this->request->getData()) ? null : $this->request->getData()),
            'event' => $event
        ]);

        // Save log
        if ($this->StudentVideoLogs->save($studentVideoLog)) {
            return $this->response->withStatus(201);
        } else {
            $this->response->getBody()->write(json_encode([ 'error' => 'validation', 'error_fields' => $studentVideoLog->getErrors() ]));
            return $this->response->withType('application/json')->withStatus(422);
        }
    }

    public function read($lesson_topic_id = null, $lesson_topic_video_id = null)
    {
        // Get lesson topic video
        $lessonTopicVideo = $this->StudentVideoLogs->LessonTopicVideos->get($lesson_topic_video_id, [ 'contain' => 'LessonTopics' ]);
        if ($lessonTopicVideo->lesson_topic_id != $lesson_topic_id || $lessonTopicVideo->lesson_topic->class_room_id != $this->Authentication->getIdentityData('class_room_id')) {
            throw new NotFoundException();
        }

        // Get logs
        $logs = $this->StudentVideoLogs->find()->select([ 'context', 'event' ])->where([ 'lesson_topic_video_id' => $lesson_topic_video_id, 'student_id' => $this->Authentication->getIdentityData('id') ]);

        /** @var StudentVideoLog $log */
        $logs->each(function($log) {
           $log->context = json_decode($log->context, true);
        });

        // Send to browser
        $this->response->getBody()->write(json_encode($logs));
        return $this->response->withType('application/json');
    }
}
