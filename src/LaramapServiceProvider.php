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
        $this->registerService();
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'laramap'
        ];
    }

    /**
     * Register service class.
     */
    protected function registerService()
    {
        $this->app->singleton('laramap', function () {
            return new Response();
        });
        $this->app->alias('laramap', Response::class);
    }
}
