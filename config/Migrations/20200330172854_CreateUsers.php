<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $users
            ->addColumn('name', 'string', [ 'limit' => 60 ])
            ->addColumn('email', 'string', [ 'limit' => 100 ])
            ->addColumn('password', 'string', [ 'limit' => 255 ])
            ->addColumn('type', 'enum', [ 'values' => [ 'root', 'admin', 'user' ], 'default' => 'user' ])
            ->addColumn('is_active', 'boolean', [ 'default' => true ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->addIndex('email', [ 'unique' => true ])
            ->create();
    }

}
