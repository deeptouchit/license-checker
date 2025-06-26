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
        // লাইসেন্স ক্লাস রেজিস্টার করো
        $this->app->singleton(License::class, function ($app) {
            return new License(new Client()); // Guzzle HTTP client ইনজেক্ট করা হচ্ছে
        });

        // কনফিগ ফাইল এবং Middleware ফাইল একসাথে পাবলিশ করার জন্য একই ট্যাগ ব্যবহার করা হচ্ছে
        $this->publishes([
            __DIR__.'/../config/license.php' => config_path('license.php'), // কনফিগ ফাইল পাবলিশ করা হচ্ছে
            __DIR__.'/../middleware/LicenseCheck.php' => app_path('Http/Middleware/LicenseCheck.php'), // Middleware ফাইল পাবলিশ করা হচ্ছে
        ], 'license'); // একই ট্যাগ 'license' দিয়ে পাবলিশ করা হচ্ছে
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // কনফিগ ফাইলটি অ্যাপ্লিকেশনে লোড করুন
        $this->mergeConfigFrom(
            __DIR__.'/../config/license.php', 'license'
        );
    }
}
