<?php


namespace App\Http\Routes\Cms;

use App\Http\Controllers\Cms\CmsCreatorAjaxIndexController;
use App\Http\Controllers\Cms\CmsDiscountAjaxIndexController;
use App\Http\Controllers\Cms\CmsDiscountController;
use App\Models\Creator;
use App\Models\Discount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\CmsCreatorController;

class CmsRoutesProvider
{

    private $middlewares = [
        'auth',
    ];

    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => '/cms',
            'middleware' => $this->middlewares,
        ], function () {
            Route::resource('creators', CmsCreatorController::class)
                ->except('show')
                ->names([
                    'index' => CmsRoutes::CREATOR_INDEX,
                    'create' => CmsRoutes::CREATOR_CREATE,
                    'store' => CmsRoutes::CREATOR_STORE,
                    'edit' => CmsRoutes::CREATOR_EDIT,
                    'update' => CmsRoutes::CREATOR_UPDATE,
                    'destroy' => CmsRoutes::CREATOR_DESTROY,
                ]);
            Route::resource('discounts', CmsDiscountController::class)
                ->except('show')
                ->names([
                    'index' => CmsRoutes::DISCOUNT_INDEX,
                    'create' => CmsRoutes::DISCOUNT_CREATE,
                    'store' => CmsRoutes::DISCOUNT_STORE,
                    'edit' => CmsRoutes::DISCOUNT_EDIT,
                    'update' => CmsRoutes::DISCOUNT_UPDATE,
                    'destroy' => CmsRoutes::DISCOUNT_DESTROY,
                ]);
        });
    }

    public static function creatorIndex(): string
    {
        return route(CmsRoutes::CREATOR_INDEX);
    }

    public static function creatorCreate(): string
    {
        return route(CmsRoutes::CREATOR_CREATE);
    }

    public static function creatorStore(): string
    {
        return route(CmsRoutes::CREATOR_STORE);
    }

    public static function creatorEdit(Creator $creator): string
    {
        return route(CmsRoutes::CREATOR_EDIT, ['creator' => $creator]);
    }

    public static function creatorUpdate(Creator $creator): string
    {
        return route(CmsRoutes::CREATOR_UPDATE, ['creator' => $creator]);
    }

    public static function creatorDestroy(Creator $creator): string
    {
        return route(CmsRoutes::CREATOR_DESTROY, ['creator' => $creator]);
    }

    public static function discountIndex(): string
    {
        return route(CmsRoutes::DISCOUNT_INDEX);
    }

    public static function discountCreate(): string
    {
        return route(CmsRoutes::DISCOUNT_CREATE);
    }

    public static function discountStore(): string
    {
        return route(CmsRoutes::DISCOUNT_STORE);
    }

    public static function discountEdit(Discount $discount): string
    {
        return route(CmsRoutes::DISCOUNT_EDIT, ['discount' => $discount]);
    }

    public static function discountUpdate(Discount $discount): string
    {
        return route(CmsRoutes::DISCOUNT_UPDATE, ['discount' => $discount]);
    }

    public static function discountDestroy(Discount $discount): string
    {
        return route(CmsRoutes::DISCOUNT_DESTROY, ['discount' => $discount]);
    }

}
