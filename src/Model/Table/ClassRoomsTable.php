<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\ClassRoom;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassRooms Model
 *
 * @property \App\Model\Table\LessonTopicsTable&\Cake\ORM\Association\HasMany $LessonTopics
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\HasMany $Students
 *
 * @method \App\Model\Entity\ClassRoom newEmptyEntity()
 * @method \App\Model\Entity\ClassRoom newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClassRoom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassRoom get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassRoom findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClassRoom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassRoom[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassRoom|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassRoom saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassRoom[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClassRoom[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClassRoom[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClassRoom[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassRoomsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('class_rooms');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('LessonTopics', [
            'foreignKey' => 'class_room_id',
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'class_room_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']));

        $rules->addDelete($rules->isNotLinkedTo('Students', 'students'));
        $rules->addDelete($rules->isNotLinkedTo('LessonTopics', 'lesson_topic'));

        return $rules;
    }
}
