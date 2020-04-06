<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonTopicFile Entity
 *
 * @property int $id
 * @property int $lesson_topic_id
 * @property string $name
 * @property string $type
 * @property int $size
 * @property string|null $notes
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\LessonTopic $lesson_topic
 */
class LessonTopicFile extends Entity
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
        'name' => true,
        'type' => true,
        'size' => true,
        'notes' => true,
        'created' => true,
        'modified' => true,
        'lesson_topic' => true,
    ];
}
