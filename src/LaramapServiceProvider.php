<?php

namespace Thomzee\Laramap;

use Illuminate\Support\ServiceProvider;
use Thomzee\Laramap\Facades\Laramap;

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
        $this->registerApp();
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

    public function provides()
    {
        return [
            'laramap'
        ];
    }

    protected function registerApp()
    {
        $this->app->singleton('laramap', function () {
            return new Response();
        });
        $this->app->alias('laramap', Response::class);
    }
}
