<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accounts Model
 *
 * @method \App\Model\Entity\Account newEmptyEntity()
 * @method \App\Model\Entity\Account newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Account> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Account get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Account findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Account patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Account> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Account|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Account saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Account>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Account>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Account>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Account> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Account>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Account>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Account>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Account> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('accounts');
        $this->setDisplayField('user_mail');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
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
            //it just checks if there is a key *name* in validation array (doesn't matter if value is empty or null)
            ->requirePresence('user_mail', true, 'Email field is required')
            //email validation in a nutshell
            //
            //is string
            //should I use build in regex or custom
            //check if str formatted to satisfy regex
            //additional availability check if *deep* is true
            //
            //at least f@f.ff
            ->email('user_mail', false, 'Email format is wrong')
            //it just doesnt allow to paste/input more than *num* symbols
            ->maxLength('user_mail', 128, 'Max length for an email is 128 symbols');

        //should contain
        //at least 1 number
        //at least one upper case letter
        //at leat one lower case letter
//        $validator
//            //what does this mean
//            ->scalar('password', 'Password must contain at least 1 number(s)')
//            //I want in between 8 and 23
//            ->lengthBetween('password', [8, 23], 'Password length must be between 8 and 23, inclusively')
//            //is password rule name valid in terms on conventions
//            ->add('password', 'strict-password', [
//                'rule' => function ($value, $context) {
//                },
//                'message' => 'Password at least must have:\n'
//            ]);
//            //create here cause I only have account creation form
//            //in the future I might consider adding "true"/"update" option
//            ->requirePresence('password', 'create', 'Password field is required')
//            ->notEmptyString('password', 'Password can\'t be empty');

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
        $rules->add($rules->isUnique(['user_mail']), [
            'errorField' => 'user_mail',
            'message' => 'This email is already in use'
        ]);

        return $rules;
    }
}
