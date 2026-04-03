<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class UsersTable extends Table{
    public function initialize(array $config): void{
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp'); 

        $this->hasMany('Recipes');

        $this->belongsToMany('Recipes', [
            'through' => 'Favorites',
        ]);

        $this->hasMany('Favorites', [
        'foreignKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username', 'Le nom d\'utilisateur est obligatoire');
            //->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->allowEmptyString('password');

        $validator
        ->email('email') 
        ->notEmptyString('email', 'L\'adresse mail est obligatoire');

        $validator
        ->notEmptyString('nom', 'Le nom est obligatoire')
        ->notEmptyString('prenom', 'Le prénom est obligatoire');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username'], ['allowMultipleNulls' => true]), ['errorField' => 'username']);

        return $rules;
    }
}
