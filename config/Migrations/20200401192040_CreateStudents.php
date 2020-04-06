<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateStudents extends AbstractMigration
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
        $clasrooms = $this->table('students');
        $clasrooms
            ->addColumn('class_room_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('tc_kimlik', 'string', [ 'limit' => 45 ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->addIndex('user_id', [ 'unique' => true ])
            ->addIndex([ 'user_id', 'class_room_id' ], [ 'unique' => true ])
            ->create();
    }
}
