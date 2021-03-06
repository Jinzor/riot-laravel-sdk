<?php

namespace Lbrs\Riot\Laravel;

use Illuminate\Support\ServiceProvider;
use Lbrs\Riot\RiotSDK;

/**
 * Service Provider
 * @version 1.0.0
 * @author  Loïc Brisset
 */
class RiotServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('riot.php'),
        ]);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'riot');
        $this->app->singleton('riot.config', function ($app) {
            return $this->app['config']['riot'];
        });
        $this->app->singleton(RiotSDK::class, function ($app) {
            $config = $app['riot.config'];
            return new RiotSDK($config['key']);
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            RiotSDK::class,
        ];
    }
}