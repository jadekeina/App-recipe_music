<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class RecipesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('recipes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
        ]);

        $this-> belongsToMany('FavoriteUsers', [
            'classname' => 'Users',
            'through' => 'Favorites',
            'foreignKey' => 'recipe_id',
            'targetForeignKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('title', 'Le titre est obligatoire')
            ->maxLength('title', 100, 'Le titre ne peut pas dépasser 100 caractères');

        $validator
            ->notEmptyString('ingredients', 'Les ingrédients sont obligatoires');

        $validator
            ->notEmptyString('steps', 'Les étapes sont obligatoires');

        $validator
            ->integer('duration', 'La durée doit être un nombre entier')
            ->notEmpty('duration', 'La durée est obligatoire');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'));

        return $rules;
    }
}