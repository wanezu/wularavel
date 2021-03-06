<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-8-13
 * Time: 下午12:23
 */

namespace App\Api\Controllers;


use App\Api\Transformers\LessonTransformer;
use App\Lesson;

class LessonsController extends BaseController
{
    public function index()
    {
        $lesson =  Lesson::all();
        return $this->collection($lesson, new LessonTransformer());
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson)
        {
            return $this->response->errorNotFound('not found');
        }
        return $this->item($lesson, new LessonTransformer());
    }
}