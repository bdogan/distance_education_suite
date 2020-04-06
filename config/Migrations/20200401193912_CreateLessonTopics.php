<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLessonTopics extends AbstractMigration
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
        $lessons = $this->table('lesson_topics');
        $lessons
            ->addColumn('class_room_id', 'integer')
            ->addColumn('lesson', 'string', [ 'limit' => 100 ])
            ->addColumn('subject', 'string', [ 'limit' => 255 ])
            ->addColumn('notes', 'text', [ 'null' => true ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->create();
    }
}
