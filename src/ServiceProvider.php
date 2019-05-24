<?php

namespace timramseyjr\CartRecovery;

use Illuminate\Console\Scheduling\Schedule;
use timramseyjr\CartRecovery\Commands\SendRecoveryEmails;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/cart-recovery.php';

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            self::CONFIG_PATH => config_path('cart-recovery.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cartrecovery');
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/timramseyjr'),
        ], 'public');
        if ($this->app->runningInConsole()) {
            $this->commands([
                SendRecoveryEmails::class
            ]);
        }
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('cartrecovery:send')->hourly();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'cart-recovery'
        );
        $this->app->bind('cart-recovery', function () {
            return new CartRecovery();
        });
        $this->app->register(EventServiceProvider::class);
    }
}
