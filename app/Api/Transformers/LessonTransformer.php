<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-8-13
 * Time: 下午12:30
 */

namespace App\Api\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean) $lesson['free']
        ];
    }
}