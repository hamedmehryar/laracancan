<?php namespace Hamedmehryar\Laracancan;

/**
 * This file is part of Laracancan,
 * a resource based permission management solution for Laravel.
 *
 * @license MIT
 * @package Hamedmehryar\Laracancan
 */

use Illuminate\Support\Facades\Facade;

class LaracancanFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laracancan';
    }
}
