<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UpdateLessonTopics extends AbstractMigration
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
        $lessonTopics = $this->table('lesson_topics');
        $lessonTopics
            ->addColumn('subject_order', 'integer', [ 'null' => true, 'default' => 99999 ])
            ->addColumn('lesson_order', 'integer', [ 'null' => true, 'default' => 99999 ])
            ->update();
    }
}
