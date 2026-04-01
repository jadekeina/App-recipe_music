<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Recipe extends Entity
{
    protected $_accessible = [
        'title' => true,
        'ingredients' => true,  
        'steps'       => true,  
        'duration'    => true, 
        'user_id'     => true,
        'created'     => true,
        'modified'    => true,
        'spotify_playlist_id' => true,
    ];
}