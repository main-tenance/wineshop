<?php


namespace App\Http\Routes\Web;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Creator\CreatorSendPdfController;
use App\Http\Controllers\Web\Front\MainIndexController;
use App\Http\Controllers\Web\Offer\OfferShowController;
use App\Http\Controllers\Web\Passport\PassportIndexController;
use App\Http\Controllers\Web\User\UserEditController;
use App\Http\Controllers\Web\User\UserUpdateController;
use App\Http\Controllers\Web\Review\ReviewController;
use App\Http\Controllers\Web\Search\SearchPopupController;
use App\Models\Creator;
use App\Models\Offer;
use App\Models\Review;
use App\Models\User;
use App\Services\Locale\LocaleService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Creator\CreatorIndexController;
use App\Http\Controllers\Web\Creator\CreatorShowController;


class WebRoutesProvider
{
    private $middlewares = [
        'localize',
        'vip',
    ];

    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => '/{locale}',
            'middleware' => $this->middlewares,
        ], function () {
            Route::get('/register', [RegisterController::class, 'create'])
                ->middleware('guest')
                ->name(WebRoutes::USER_CREATE);

            Route::get('/get_register_popup', [RegisterController::class, 'createPopup'])
                ->middleware('guest')
                ->name(WebRoutes::USER_CREATE_POPUP);

            Route::post('/register', [RegisterController::class, 'store'])
                ->middleware('guest')
                ->name(WebRoutes::USER_STORE);

            Route::get('/login', [LoginController::class, 'create'])
                ->middleware('guest')
                ->name(WebRoutes::LOGIN);

            Route::get('/get_login_popup', [LoginController::class, 'createPopup'])
                ->middleware('guest')
                ->name(WebRoutes::LOGIN_POPUP);

            Route::post('/login', [LoginController::class, 'store'])
                ->middleware('guest')
                ->name(WebRoutes::LOGIN_STORE);

            Route::get('/creators', CreatorIndexController::class)
                ->name(WebRoutes::CREATOR_INDEX);

            Route::get('/creators/{creator:code}', CreatorShowController::class)
                ->name(WebRoutes::CREATOR_SHOW);

            Route::get('/creators/send_pdf/{creator:code}', CreatorSendPdfController::class)
                ->name(WebRoutes::CREATOR_SEND_PDF)
                ->middleware('auth');

            Route::get('/', MainIndexController::class)
                ->name(WebRoutes::MAIN_INDEX);

            Route::view('/about', 'about.index')
                ->name(WebRoutes::ABOUT_INDEX);

            Route::get('/search/popup', SearchPopupController::class)
                ->name(WebRoutes::SEARCH_POPUP);

            Route::get('/offers/{offer:code}', OfferShowController::class)
                ->name(WebRoutes::OFFER_SHOW);

            Route::resource('offers.reviews', ReviewController::class)
                ->parameters(['offers' => 'offer:code', 'reviews' => 'review'])
                ->names([
                    'index' => WebRoutes::REVIEW_INDEX,
                    'show' => WebRoutes::REVIEW_SHOW,
                    'create' => WebRoutes::REVIEW_CREATE,
                    'store' => WebRoutes::REVIEW_STORE,
                    'edit' => WebRoutes::REVIEW_EDIT,
                    'update' => WebRoutes::REVIEW_UPDATE,
                    'destroy' => WebRoutes::REVIEW_DESTROY,
                ]);

            Route::middleware('auth')->group(function () {
                Route::get('/profile/{user?}', UserEditController::class)
                    ->name(WebRoutes::USER_EDIT);

                Route::put('/profile/{user}', UserUpdateController::class)
                    ->name(WebRoutes::USER_UPDATE);

                Route::get('/passport', PassportIndexController::class)
                    ->name(WebRoutes::PASSPORT_INDEX);
            });
        });
    }


    public static function mainIndex(): string
    {
        return route(WebRoutes::MAIN_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function aboutIndex(): string
    {
        return route(WebRoutes::ABOUT_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function searchPopup(): string
    {
        return route(WebRoutes::SEARCH_POPUP, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userCreate(): string
    {
        return route(WebRoutes::USER_CREATE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userCreatePopup(): string
    {
        return route(WebRoutes::USER_CREATE_POPUP, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userStore(): string
    {
        return route(WebRoutes::USER_STORE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function login(): string
    {
        return route(WebRoutes::LOGIN, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function loginPopup(): string
    {
        return route(WebRoutes::LOGIN_POPUP, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function loginStore(): string
    {
        return route(WebRoutes::LOGIN_STORE, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userEdit(User $user = null): string
    {
        return route(WebRoutes::USER_EDIT, ['user' => $user, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function userUpdate(User $user): string
    {
        return route(WebRoutes::USER_UPDATE, ['user' => $user, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function creatorIndex(): string
    {
        return route(WebRoutes::CREATOR_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function creatorShow(Creator $creator): string
    {
        return route(WebRoutes::CREATOR_SHOW, ['creator' => $creator, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function creatorSendPdf(Creator $creator): string
    {
        return route(WebRoutes::CREATOR_SEND_PDF, ['creator' => $creator, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function offerShow(Offer $offer): string
    {
        return route(WebRoutes::OFFER_SHOW, ['offer' => $offer, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewIndex(Offer $offer): string
    {
        return route(WebRoutes::REVIEW_INDEX, ['offer' => $offer, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewCreate(Offer $offer): string
    {
        return route(WebRoutes::REVIEW_CREATE, ['offer' => $offer, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewStore(Offer $offer): string
    {
        return route(WebRoutes::REVIEW_STORE, ['offer' => $offer, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewShow(Offer $offer, Review $review): string
    {
        return route(WebRoutes::REVIEW_SHOW, ['offer' => $offer, 'review' => $review, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewEdit(Offer $offer, Review $review): string
    {
        return route(WebRoutes::REVIEW_EDIT, ['offer' => $offer, 'review' => $review, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewUpdate(Offer $offer, Review $review): string
    {
        return route(WebRoutes::REVIEW_UPDATE, ['offer' => $offer, 'review' => $review, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function reviewDestroy(Offer $offer, Review $review): string
    {
        return route(WebRoutes::REVIEW_DESTROY, ['offer' => $offer, 'review' => $review, LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

    public static function passportIndex(): string
    {
        return route(WebRoutes::PASSPORT_INDEX, [LocaleService::PARAMETER_LOCALE => App::getLocale()]);
    }

}
