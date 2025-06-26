<?php

namespace Deeptouchit\LicenseChecker;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class LicenseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(License::class, function ($app) {
            return new License(new Client());
        });

        $this->publishes([
            __DIR__.'/../config/license.php' => config_path('license.php'),
            __DIR__.'/Middleware/LicenseCheck.php' => app_path('Http/Middleware/LicenseCheck.php'),
        ], 'license');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/license.php', 'license'
        );
    }
}
