<?php

namespace App\Providers;

use App\Http\Controllers\TestController;
use App\Services\Notification\EmailNotificationService;
use App\Services\Notification\LogNotificationService;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(NotificationServiceInterface::class,
//            fn() => new LogNotificationService(app('log')));
//        $this->app->when(LogNotificationService::class)
//            ->needs('$count')
//            ->give(2);

        $service = new LogNotificationService(app('log'));
//        $this->app->instance(NotificationServiceInterface::class, $service);
        $this->app->bind(NotificationServiceInterface::class, fn() => $service);
        $this->app->bind('myint', function () {
            return 100;
        });

        $this->app->when(TestController::class)
            ->needs(NotificationServiceInterface::class)
            ->give(EmailNotificationService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->app->resolving(fn($object) => dump($object));
    }
}
