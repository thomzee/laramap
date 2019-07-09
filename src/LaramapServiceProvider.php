<?php

namespace Thomzee\Laramap;

use Illuminate\Support\ServiceProvider;

class LaramapServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Thomzee\Laramap\Commands\GenerateMapper',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
