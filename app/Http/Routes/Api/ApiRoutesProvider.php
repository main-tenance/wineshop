<?php

namespace App\Http\Routes\Api;

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UserInfoController;
use App\Http\Controllers\Api\V1\UserShowController;
use App\Http\Controllers\Api\V1\VineController;
use App\Models\Order;
use App\Models\User;
use App\Models\Vine;
use App\Services\Locale\LocaleService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class ApiRoutesProvider
{

    private $prefix = '/v1/{locale}';

    public function registerRoutes(): void
    {
        $this->routesV1();
    }

    public function routesV1(): void
    {
        Route::group([
            'prefix' => $this->prefix,
            'middleware' => ['localize', 'auth:api'],
        ], function () {
            Route::resource('vines', VineController::class)
                ->except(['create', 'edit'])
                ->parameters(['vines' => 'vine:code'])
                ->names([
                    'index' => ApiRoutes::VINE_INDEX,
                    'show' => ApiRoutes::VINE_SHOW,
                    'store' => ApiRoutes::VINE_STORE,
                    'update' => ApiRoutes::VINE_UPDATE,
                    'destroy' => ApiRoutes::VINE_DESTROY,
                ]);
            Route::resource('users', UserController::class)
                ->only(['store', 'show', 'update', 'destroy'])
                ->parameters(['users' => 'user'])
                ->names([
                    'show' => ApiRoutes::USER_SHOW,
                    'store' => ApiRoutes::USER_STORE,
                    'update' => ApiRoutes::USER_UPDATE,
                    'destroy' => ApiRoutes::USER_DESTROY,
                ]);
            Route::get('user', UserInfoController::class)
                ->name(ApiRoutes::USER_INFO);
        });

        Route::group([
            'prefix' => $this->prefix,
            'middleware' => ['localize', 'client:see-orders'],
        ], function () {
            Route::resource('orders', OrderController::class)
                ->only(['index', 'show'])
                ->parameters(['orders' => 'order'])
                ->names([
                    'index' => ApiRoutes::ORDER_INDEX,
                    'show' => ApiRoutes::ORDER_SHOW,
                ]);
            Route::resource('orders', OrderController::class)
                ->only(['store', 'update', 'destroy'])
                ->middleware('client:modify-orders')
                ->parameters(['orders' => 'order'])
                ->names([
                    'store' => ApiRoutes::ORDER_STORE,
                    'update' => ApiRoutes::ORDER_UPDATE,
                    'destroy' => ApiRoutes::ORDER_DESTROY,
                ]);
        });
    }

    public static function vineIndex(): string
    {
        return route(ApiRoutes::VINE_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function vineStore(): string
    {
        return route(ApiRoutes::VINE_STORE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function vineShow(Vine $vine): string
    {
        return route(ApiRoutes::VINE_SHOW, ['vine' => $vine, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function vineUpdate(Vine $vine): string
    {
        return route(ApiRoutes::VINE_UPDATE, ['vine' => $vine, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function vineDestroy(Vine $vine): string
    {
        return route(ApiRoutes::VINE_DESTROY, ['vine' => $vine, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userInfo(): string
    {
        return route(ApiRoutes::USER_INFO, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userStore(): string
    {
        return route(ApiRoutes::USER_STORE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userShow(User $user): string
    {
        return route(ApiRoutes::USER_SHOW, ['user' => $user, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userUpdate(User $user): string
    {
        return route(ApiRoutes::USER_UPDATE, ['user' => $user, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userDestroy(User $user): string
    {
        return route(ApiRoutes::USER_DESTROY, ['user' => $user, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function orderIndex(): string
    {
        return route(ApiRoutes::ORDER_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function orderStore(): string
    {
        return route(ApiRoutes::ORDER_STORE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function orderShow(Order $order): string
    {
        return route(ApiRoutes::ORDER_SHOW, ['order' => $order, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function orderUpdate(Order $order): string
    {
        return route(ApiRoutes::ORDER_UPDATE, ['order' => $order, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function orderDestroy(Order $order): string
    {
        return route(ApiRoutes::ORDER_DESTROY, ['order' => $order, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }
}
