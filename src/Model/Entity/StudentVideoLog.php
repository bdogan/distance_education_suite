<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentVideoLog Entity
 *
 * @property int $id
 * @property int $lesson_topic_video_id
 * @property int $student_id
 * @property string $event
 * @property string|null $context
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\LessonTopicVideo $lesson_topic_video
 * @property \App\Model\Entity\Student $student
 */
class StudentVideoLog extends Entity
{

    /**
     * Constants
     */
    const VIEW_EVENT = 'view';
    const PLAY_EVENT = 'play';
    const END_EVENT = 'ended';
    const PLAYING_EVENT = 'playing';

    /**
     * @return array
     */
    public static function events()
    {
        return [
            self::VIEW_EVENT,
            self::PLAY_EVENT,
            self::END_EVENT,
            self::PLAYING_EVENT
        ];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'lesson_topic_video_id' => true,
        'student_id' => true,
        'event' => true,
        'context' => true,
        'created' => true,
        'lesson_topic_video' => true,
        'student' => true,
    ];
}
