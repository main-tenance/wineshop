<?php

namespace App\Providers;

use App\Jobs\SendCreatorPdfCatalogJob;
use App\Services\Notifications\Sms\Providers\LogSmsProvider;
use App\Services\Notifications\Sms\Providers\SmsProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmsProvider::class, LogSmsProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        RateLimiter::for(SendCreatorPdfCatalogJob::$onQueue, function ($job) {
            return $job->user->isVip()
                ? Limit::none()
                : Limit::perHour(3)->by($job->user->id);
        });
    }
}
