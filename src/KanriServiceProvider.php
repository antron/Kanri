<?php

namespace Antron\Kanri;

use Illuminate\Support\ServiceProvider;

class KanriServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('kanri',function($app)
        {
            return new Kanri;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['kanri'];
    }

}
