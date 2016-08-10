<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-8-10
 * Time: 下午11:25
 */

namespace App\Transformer;


/**
 * Class Transformer
 * @package App\Transformer
 */
abstract class Transformer
{
    /**
     * @param $items
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this,'transform'],$items);
    }

    /**
     * @param $item
     * @return mixede
     */
    public abstract function transform($item);
}