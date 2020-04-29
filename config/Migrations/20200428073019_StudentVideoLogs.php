<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class StudentVideoLogs extends AbstractMigration
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
        $userVideoLogs = $this->table('student_video_logs');
        $userVideoLogs
            ->addColumn('lesson_topic_video_id', 'integer')
            ->addColumn('student_id', 'integer')
            ->addColumn('event', 'string', [ 'null' => false ])
            ->addColumn('context', 'text', [ 'null' => true, 'default' => null ])
            ->addColumn('created', 'datetime')
            ->create();
    }
}
