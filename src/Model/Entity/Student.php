<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property int $class_room_id
 * @property int $user_id
 * @property string $tc_kimlik
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ClassRoom $class_room
 * @property \App\Model\Entity\User $user
 */
class Student extends Entity
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
        'user_id' => true,
        'tc_kimlik' => true,
        'created' => true,
        'modified' => true,
        'class_room' => true,
        'user' => true,
    ];
}
