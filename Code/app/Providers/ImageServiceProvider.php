<?php

namespace App\Providers;

use App\Contracts\Image\Strategy as StrategyContract;
use App\Services\Image\AliyunOss\Strategy;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{

    protected $defer = true;

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
        $this->app->singleton(StrategyContract::class, function($app) {
            return new Strategy();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [StrategyContract::class];
    }


}
