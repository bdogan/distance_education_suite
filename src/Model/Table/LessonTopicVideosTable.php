<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonTopicVideos Model
 *
 * @property \App\Model\Table\LessonTopicsTable&\Cake\ORM\Association\BelongsTo $LessonTopics
 * @property \App\Model\Table\VideosTable&\Cake\ORM\Association\BelongsTo $Videos
 *
 * @method \App\Model\Entity\LessonTopicVideo newEmptyEntity()
 * @method \App\Model\Entity\LessonTopicVideo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicVideo get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicVideo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicVideo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonTopicVideosTable extends Table
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

        $this->setTable('lesson_topic_videos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('LessonTopics', [
            'foreignKey' => 'lesson_topic_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('StudentVideoLogs', [
            'foreignKey' => 'lesson_topic_video_id'
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
            ->scalar('app_alias')
            ->maxLength('app_alias', 45)
            ->requirePresence('app_alias', 'create')
            ->notEmptyString('app_alias');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyString('duration');

        $validator
            ->scalar('thumbnail')
            ->maxLength('thumbnail', 255)
            ->requirePresence('thumbnail', 'create')
            ->notEmptyString('thumbnail');

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
        $rules->add($rules->existsIn(['lesson_topic_id'], 'LessonTopics'));

        return $rules;
    }

    /**
     * @param \Cake\ORM\Query $query
     * @param array $options
     *
     * @return \Cake\ORM\Query
     */
    public function findByLesson(Query $query, array $options)
    {
        /** @var \App\Model\Entity\LessonTopic $lesson */
        $lesson = $options['lesson'];
        return $query->where([ 'lesson_topic_id' => $lesson->id ]);
    }

}
