<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-8-10
 * Time: 下午11:30
 */

namespace App\Transformer;


/**
 * Class LessonTransformer
 * @package App\Transformer
 */
class LessonTransformer extends Transformer
{
    /**
     * @param $lesson
     * @return array
     */
    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean) $lesson['free']
        ];
    }
}