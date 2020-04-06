<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\LessonTopicFile;
use Cake\Event\EventInterface;
use Cake\Filesystem\File;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Psr\Http\Message\UploadedFileInterface;

/**
 * LessonTopicFiles Model
 *
 * @property \App\Model\Table\LessonTopicsTable&\Cake\ORM\Association\BelongsTo $LessonTopics
 *
 * @method \App\Model\Entity\LessonTopicFile newEmptyEntity()
 * @method \App\Model\Entity\LessonTopicFile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonTopicFile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LessonTopicFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicFile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonTopicFile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopicFile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonTopicFile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicFile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicFile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LessonTopicFile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonTopicFilesTable extends Table
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

        $this->setTable('lesson_topic_files');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('LessonTopics', [
            'foreignKey' => 'lesson_topic_id',
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
            ->requirePresence('_file', 'create')
            ->notEmptyFile('_file')
            ->add('_file', [
                'type' => [
                    'rule' => [ 'mimeType', [ 'image/jpeg', 'image/png', 'application/pdf', 'image/jpg', 'image/tiff' ] ],
                    'message' => 'Geçersiz dosya formatı'
                ]
            ])
            ->add('_file', [
               'unique' => [
                   'rule' => function($value, $context) {
                        if ($value && $value instanceof UploadedFileInterface) {
                            $file = UPLOAD_PATH . DS . $value->getClientFilename();
                            return !file_exists($file);
                        }
                        return true;
                   },
                   'message' => 'Aynı isimle dosya mevcut'
               ]
            ]);

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 10)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('size')
            ->requirePresence('size', 'create')
            ->notEmptyString('size');

        $validator
            ->scalar('notes')
            ->maxLength('notes', 255)
            ->allowEmptyString('notes');

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

        $rules->add($rules->existsIn(['lesson_topic_id'], 'LessonTopics'));

        return $rules;
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \App\Model\Entity\LessonTopicFile $entity
     * @param \ArrayObject $options
     */
    public function afterDelete(EventInterface $event, LessonTopicFile $entity, \ArrayObject $options)
    {
        $file = UPLOAD_PATH . $entity->name;
        if (file_exists($file)) {
            unlink($file);
        }
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
