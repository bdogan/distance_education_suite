<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClassRooms extends AbstractMigration
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
        $clasrooms = $this->table('class_rooms');
        $clasrooms
            ->addColumn('name', 'string', [ 'limit' => 255 ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->create();
    }
}
