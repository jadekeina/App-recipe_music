<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FavoritesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('favorites');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users');
        $this->belongsto('Recipes');

        $this->addBehavior('Timestamp');
    }
}