<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLessonTopicFiles extends AbstractMigration
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
        $lessons = $this->table('lessons');
        $lessons
            ->addColumn('lesson_topic_id', 'integer')
            ->addColumn('name', 'string', [ 'limit' => 100 ])
            ->addColumn('type', 'string', [ 'limit' => 10 ])
            ->addColumn('size', 'integer')
            ->addColumn('notes', 'string', [ 'limit' => 255, 'null' => true ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->create();
    }
}
