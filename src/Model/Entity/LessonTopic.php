<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonTopic Entity
 *
 * @property int $id
 * @property int $class_room_id
 * @property string $lesson
 * @property string $subject
 * @property string|null $notes
 * @property int $subject_order
 * @property int $lesson_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ClassRoom $class_room
 * @property \App\Model\Entity\LessonTopicFile[] $lesson_topic_files
 * @property \App\Model\Entity\LessonTopicVideo[] $lesson_topic_videos
 */
class LessonTopic extends Entity
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
        'class_room_id' => true,
        'lesson' => true,
        'lesson_order' => true,
        'subject' => true,
        'subject_order' => true,
        'notes' => true,
        'created' => true,
        'modified' => true,
        'class_room' => true,
        'lesson_topic_files' => true,
    ];
}
