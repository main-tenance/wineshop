<?php

use App\Http\Controllers\TestController;
use App\Policies\Gates\Gates;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Routes\Web\WebRoutesProvider;
use App\Http\Routes\Cms\CmsRoutesProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

app(CmsRoutesProvider::class)->registerRoutes();

Route::get('/secret', function () {
    Gate::authorize(Gates::VIEW_SECRET_CONTENT);
    return 'Secret Content';
});
Route::get('/settings', function () {
    Gate::authorize(Gates::UPDATE_SETTINGS);
    return 'Settings';
});

Route::get('/test', [TestController::class, 'index']);
Route::post('/test', [TestController::class, 'store']);
Route::get('/welcome', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

app(WebRoutesProvider::class)->registerRoutes();
