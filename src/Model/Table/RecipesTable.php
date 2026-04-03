<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recipes Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Recipe newEmptyEntity()
 * @method \App\Model\Entity\Recipe newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Recipe[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Recipe get($primaryKey, $options = [])
 * @method \App\Model\Entity\Recipe findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Recipe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Recipe[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Recipe|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Recipe saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RecipesTable extends Table
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

        $this->setTable('recipes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Favorites', [
            'foreignKey' => 'recipe_id',
        ]);
        $this->hasMany('RecipePlaylists', [
            'foreignKey' => 'recipe_id',
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('ingredients')
            ->maxLength('ingredients', 255)
            ->requirePresence('ingredients', 'create')
            ->notEmptyString('ingredients');

        $validator
            ->scalar('steps')
            ->requirePresence('steps', 'create')
            ->notEmptyString('steps');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyString('duration');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('spotify_playlist_id')
            ->maxLength('spotify_playlist_id', 255)
            ->allowEmptyString('spotify_playlist_id');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create')
            ->notEmptyFile('image');

        $validator
            ->boolean('is_published')
            ->requirePresence('is_published', 'create')
            ->notEmptyString('is_published');

        $validator
        ->scalar('image')
        ->maxLength('image', 255)
        ->allowEmptyFile('image'); 

    $validator
        ->boolean('is_published')
        ->allowEmptyString('is_published');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
