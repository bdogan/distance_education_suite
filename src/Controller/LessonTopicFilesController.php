<?php

namespace App\Controller;

class LessonTopicFilesController extends AppController
{

    /**
     * @var string
     */
    public $modelClass = 'LessonTopicFiles';

    /**
     * @param string $lessonTopicId
     * @param string $id
     *
     * @return \Cake\Http\Response
     */
    public function show(string $lessonTopicId, string $id)
    {
        $this->request->allowMethod(['get']);
        $lessonTopicFile = $this->LessonTopicFiles->get($id);
        return $this->response->withFile(UPLOAD_PATH . $lessonTopicFile->name);
    }

}
