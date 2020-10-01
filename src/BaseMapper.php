<?php


namespace Thomzee\Laramap;

/**
 * Class BaseMapper
 * @package Thomzee\Laramap
 */
abstract class BaseMapper
{
    /**
     * Loop through single() function to generate multiple mapped data.
     *
     * @param $items
     * @return array
     */
    public function index($items) {
        $result = [];
        foreach($items as $item) {
            $result[] = $this->single($item);
        }
        return $result;
    }

    /**
     * Mapper class must implement this function in order to make list() function work.
     *
     * @param $item
     * @return mixed
     */
    abstract function single($item);
}
