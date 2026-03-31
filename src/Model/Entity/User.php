<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [

        'username' => true,

        'password' => true,

        'created' => true,

        'modified' => true,
    ];

    protected $_hidden = [

        'password',
    ];
}