<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\ConnectedApp;
use BackOffice\Lib\App;
use BackOffice\Lib\AppCollection;
use Cake\Datasource\ResultSetDecorator;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * ConnectedApps Model
 *
 * @method \App\Model\Entity\ConnectedApp newEmptyEntity()
 * @method \App\Model\Entity\ConnectedApp newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedApp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedApp get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConnectedApp findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ConnectedApp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedApp[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedApp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConnectedApp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConnectedApp[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConnectedApp[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConnectedApp[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConnectedApp[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConnectedAppsTable extends Table
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

        $this->setTable('connected_apps');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('alias')
            ->maxLength('alias', 45)
            ->requirePresence('alias', 'create')
            ->notEmptyString('alias')
            ->add('alias', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('access_token')
            ->maxLength('access_token', 255)
            ->requirePresence('access_token', 'create')
            ->notEmptyString('access_token');

        $validator
            ->scalar('token_type')
            ->maxLength('token_type', 45)
            ->requirePresence('token_type', 'create')
            ->notEmptyString('token_type');

        $validator
            ->scalar('user')
            ->allowEmptyString('user');

        $validator
            ->scalar('refresh_token')
            ->maxLength('refresh_token', 255)
            ->allowEmptyString('refresh_token');

        $validator
            ->scalar('scope')
            ->maxLength('scope', 255)
            ->allowEmptyString('scope');

        $validator
            ->dateTime('expires_in')
            ->allowEmptyDateTime('expires_in');

        return $validator;
    }

    /**
     * @var AppCollection
     */
    private $_appCollection;

    /**
     * @return \BackOffice\Lib\AppCollection
     */
    protected function apps(): AppCollection
    {
        return $this->_appCollection ?? ($this->_appCollection = new AppCollection());
    }

    /**
     * @param \Cake\ORM\Query $query
     * @param array $options
     *
     * @return \Cake\ORM\Query
     */
    public function findAll( Query $query, array $options = [] ): Query
    {
        $apps = new AppCollection();
        $query = parent::findAll($query, $options);
        $connectedApps = $query->toArray();
        $results = $apps->map(function (App $app) use ($connectedApps) {
            /** @var \App\Model\Entity\ConnectedApp $connectedApp */
            foreach ($connectedApps as $connectedApp) {
                if ($connectedApp->alias === $app->alias) {
                    $app->ConnectedApp = $connectedApp;
                }
            }
            return $app;
        });

        // Alias
        if ($alias = Hash::get($options, 'alias')) $results = $results->filter(function($item) use ($alias) { return $item->alias === $alias; });

        // Role option
        if ($role = Hash::get($options, 'role')) $results = $results->filter(function($item) use ($role) { return in_array($role, $item->roles); });

        // Linked
        if (Hash::check($options, 'linked') && ($linked = Hash::get($options, 'linked')) === $linked) $results = $results->filter(function($item) use ($linked) { return (!!$item->ConnectedApp === $linked); });

        $query->setResult(new ResultSetDecorator($results));
        return $query;
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
        $rules->add($rules->isUnique(['alias']));

        return $rules;
    }
}
