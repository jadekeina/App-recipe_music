<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddUserIdToRecipes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {

    $table = $this->table('recipes');

    $table
        ->addColumn('user_id', 'integer', ['null' => false])
        ->addForeignKey('user_id', 'users', 'id', [
            'delete'=> 'CASCADE',
            'update'=> 'NO_ACTION'
        ])
        ->update();
    }
}
