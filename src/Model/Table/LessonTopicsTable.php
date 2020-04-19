<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\LessonTopic;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonTopics Model
 *
 * @property \App\Model\Table\ClassRoomsTable&\Cake\ORM\Association\BelongsTo $ClassRooms
 * @property \App\Model\Table\LessonTopicFilesTable&\Cake\ORM\Association\HasMany $LessonTopicFiles
 *
 * @method \App\Model\Entity\LessonTopic newEmptyEntity()
 * @method \App\Model\Entity\LessonTopic newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopic get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonTopic findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LessonTopic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopic[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopic|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopic saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopic[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopic[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopic[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopic[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonTopicsTable extends Table
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

        $this->setTable('lesson_topics');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ClassRooms', [
            'foreignKey' => 'class_room_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('LessonTopicFiles', [
            'foreignKey' => 'lesson_topic_id',
        ]);
        $this->hasMany('LessonTopicVideos', [
            'foreignKey' => 'lesson_topic_id',
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
            ->scalar('lesson')
            ->maxLength('lesson', 100)
            ->requirePresence('lesson', 'create')
            ->notEmptyString('lesson');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 255)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->integer('class_room_id')
            ->requirePresence('class_room_id', 'create');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        return $validator;
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \App\Model\Entity\LessonTopic $entity
     * @param \ArrayObject $options
     */
    public function afterDelete(EventInterface $event, LessonTopic $entity, \ArrayObject $options)
    {
        $files = $this->LessonTopicFiles->find()->where([ 'lesson_topic_id' => $entity->id ]);
        foreach ($files as $file) {
            $this->LessonTopicFiles->delete($file);
        }
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
        $rules->add($rules->existsIn(['class_room_id'], 'ClassRooms'));

        return $rules;
    }
}
