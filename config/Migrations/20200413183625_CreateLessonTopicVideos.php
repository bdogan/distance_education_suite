<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLessonTopicVideos extends AbstractMigration
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
        $lessonTopicVideos = $this->table('lesson_topic_videos');
        $lessonTopicVideos
            ->addColumn('lesson_topic_id', 'integer')
            ->addColumn('app_alias', 'string', [ 'limit' => 45 ])
            ->addColumn('video_id', 'string', [ 'limit' => 255 ])
            ->addColumn('name', 'string', [ 'limit' => 255 ])
            ->addColumn('duration', 'integer')
            ->addColumn('thumbnail', 'string', [ 'limit' => 255 ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', [ 'null' => true ])
            ->addIndex([ 'video_id' ], [ 'unique' => true ])
            ->create();
    }
}
