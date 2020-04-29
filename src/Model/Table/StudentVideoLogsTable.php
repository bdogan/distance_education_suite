<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\StudentVideoLog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentVideoLogs Model
 *
 * @property \App\Model\Table\LessonTopicVideosTable&\Cake\ORM\Association\BelongsTo $LessonTopicVideos
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\StudentVideoLog newEmptyEntity()
 * @method \App\Model\Entity\StudentVideoLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StudentVideoLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentVideoLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentVideoLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StudentVideoLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentVideoLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentVideoLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentVideoLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentVideoLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StudentVideoLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StudentVideoLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StudentVideoLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentVideoLogsTable extends Table
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

        $this->setTable('student_video_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('LessonTopicVideos', [
            'foreignKey' => 'lesson_topic_video_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
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
            ->scalar('event')
            ->maxLength('event', 255)
            ->requirePresence('event', 'create')
            ->inList('event', StudentVideoLog::events())
            ->notEmptyString('event');

        $validator
            ->scalar('context')
            ->allowEmptyString('context');

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
        $rules->add($rules->existsIn(['lesson_topic_video_id'], 'LessonTopicVideos'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }
}
