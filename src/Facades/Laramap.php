<?php


namespace Thomzee\Laramap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Laravel REST API response mapper.
 *
 * @author     Thomas Andtianto
 * @license    MIT
 * @copyright  (c) 2019, Thomas Andrianto
 */
class Laramap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laramap';
    }
}
