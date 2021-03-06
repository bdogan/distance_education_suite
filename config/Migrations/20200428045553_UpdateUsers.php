<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UpdateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $users = $this->table('users');
        $users->addColumn('last_login', 'datetime', [ 'null' => true ])->update();
    }
}
