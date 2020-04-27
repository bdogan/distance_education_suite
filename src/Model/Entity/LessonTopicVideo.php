<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonTopicVideo Entity
 *
 * @property int $id
 * @property int $lesson_topic_id
 * @property string $app_alias
 * @property string $video_id
 * @property string $name
 * @property int $duration
 * @property string $thumbnail
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\LessonTopic $lesson_topic
 * @property \App\Model\Entity\Video $video
 */
class LessonTopicVideo extends Entity
{
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
        'lesson_topic_id' => true,
        'app_alias' => true,
        'video_id' => true,
        'name' => true,
        'duration' => true,
        'thumbnail' => true,
        'created' => true,
        'modified' => true,
        'lesson_topic' => true,
        'video' => true,
    ];
}
