<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
    protected $_accessible = [

        'username' => true,

        'nom' => true, 

        'prenom' => true,   

        'email' => true,

        'password' => true,

        'created' => true,

        'modified' => true,

        '*' => false,
    ];

    protected $_hidden = [

        'password',
    ];

    protected function _setPassword(string $password): string
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($password);
    }
}