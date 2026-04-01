<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateFavorites extends AbstractMigration
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
        $table = $this->table('favorites');

        $table
            ->addColumn('user_id', 'integer', [
                'null' => false,
            ])

            ->addColumn('recipe_id', 'integer', [
                'null' => false,
            ])

            ->addColumn('created', 'datetime', [
                'null' => true,
            ])

            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])

            ->addForeignKey('recipe_id', 'recipes', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])

            ->create();
    }
}
