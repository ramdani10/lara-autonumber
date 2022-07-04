<?php

namespace Ramdani10\AutoNumber;

use Ramdani10\AutoNumber\Observers\AutoNumberObserver;
use Illuminate\Support\ServiceProvider;
use Ramdani10\AutoNumber\AutoNumber;

class AutoNumberServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/autonumber.php' => config_path('autonumber.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AutoNumberObserver::class, function ($app) {
            return new AutoNumberObserver(new AutoNumber());
        });
    }
}
