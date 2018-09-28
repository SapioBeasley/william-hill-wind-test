<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CacheDecoratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Lib\CacheInterface',
            'App\Lib\CacheDecorator'
        );
    }
}
