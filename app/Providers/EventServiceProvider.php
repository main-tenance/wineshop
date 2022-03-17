<?php

namespace App\Providers;

use App\Services\Auth\Handlers\AttemptingEventHandler;
use App\Services\Auth\Handlers\AuthenticatedEventHandler;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Cache\Events\KeyForgotten;
use Illuminate\Cache\Events\KeyWritten;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
//        Attempting::class => [
//            AttemptingEventHandler::class,
//        ]
//        Authenticated::class => [
//            AuthenticatedEventHandler::class,
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
//        Event::listen(CacheHit::class, function ($event) {
//            Log::info(json_encode(['Cache Hit', $event], JSON_UNESCAPED_UNICODE));
//        });
//
//        Event::listen(CacheMissed::class, function ($event) {
//            Log::info(json_encode(['Cache Missed', $event], JSON_UNESCAPED_UNICODE));
//        });
//
//        Event::listen(KeyForgotten::class, function ($event) {
//            Log::info(json_encode(['Key Forgotten', $event], JSON_UNESCAPED_UNICODE));
//        });
//
//        Event::listen(KeyWritten::class, function ($event) {
//            Log::info(json_encode(['Key Written', $event], JSON_UNESCAPED_UNICODE));
//        });
    }
}
