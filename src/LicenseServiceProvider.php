<?php

namespace Deeptouchit\LicenseChecker;

use Illuminate\Support\ServiceProvider;

class LicenseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // লাইসেন্স ক্লাস রেজিস্টার করো
        $this->app->singleton(License::class, function ($app) {
            return new License(new \GuzzleHttp\Client());
        });

        // লাইসেন্স কনফিগ ফাইল পাবলিশ করতে চাইলে সেটাও রেজিস্টার করতে হবে
        $this->publishes([
            __DIR__.'/../config/license.php' => config_path('license.php'),
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // যদি আপনি কনফিগ ফাইল লোড করতে চান, সেটা এখানে করা হবে
        $this->mergeConfigFrom(
            __DIR__.'/../config/license.php', 'license'
        );
    }
}
