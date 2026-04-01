<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AlterIngredientsInRecipes extends AbstractMigration
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

        $table->changeColumn('ingredients', 'text', [
            'limit' => MysqlAdapter::TEXT_REGULAR
    ]);

        $table->update();
    }
}
