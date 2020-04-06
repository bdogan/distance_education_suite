<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\User;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationStudent(Validator $validator): Validator
    {
        $validator = $this->validationDefault($validator);

        $validator->remove('email');

        $validator
            ->email('email')
            ->allowEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * @param \Cake\Validation\Validator $validator
     *
     * @return \Cake\Validation\Validator
     */
    public function validationChangePassword(Validator $validator): Validator
    {
        $validator
            ->scalar('current_password')
            ->maxLength('current_password', 40)
            ->requirePresence('current_password')
            ->notEmptyString('current_password')
            ->add('current_password', [
                'unique' => [
                    'rule' => function($value, $context) {
                        if ($value) {
                            $id = Hash::get($context, 'data.id');
                            if ($user = $this->get($id)) {
                                $hasher = new DefaultPasswordHasher();
                                return $hasher->check($value, $user->password);
                            }
                        }
                        return true;
                    },
                    'message' => 'Şifre yanlış'
                ]
            ]);

        $validator
            ->scalar('new_password')
            ->maxLength('new_password', 40)
            ->requirePresence('new_password')
            ->notEmptyString('new_password');

        $validator
            ->scalar('new_password_verify')
            ->maxLength('new_password_verify', 40)
            ->requirePresence('new_password_verify')
            ->notEmptyString('new_password_verify')
            ->add('new_password_verify', [
                'type' => [
                    'rule' => [ 'compareWith', 'new_password' ],
                    'message' => 'Passwords are not equal'
                ]
            ]);

        return $validator;
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
            ->maxLength('name', 60)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 40)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('type')
            ->notEmptyString('type');

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    /**
     * @param \Cake\ORM\Query $query
     * @param array $options
     *
     * @return \Cake\ORM\Query
     */
    public function findAdmins(Query $query, array $options = [])
    {
        return $query->where([ 'type IN' => User::adminTypes() ]);
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \App\Model\Entity\User $user
     * @param \ArrayObject $options
     */
    public function beforeSave(EventInterface $event, User $user, \ArrayObject $options)
    {
        if (!$user->email) $user->email = null;
    }

}
