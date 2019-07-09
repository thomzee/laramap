<?php


namespace Thomzee\Laramap;

/**
 * Interface MapperContract
 * @package Thomzee\Laramap
 */
interface MapperContract
{
    /**
     * @param $item
     * @return mixed
     */
    public function single($item);

    /**
     * @param $items
     * @return mixed
     */
    public function list($items);
}
