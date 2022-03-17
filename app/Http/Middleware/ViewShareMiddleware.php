<?php

namespace App\Http\Middleware;

use App\Services\Locale\LocaleService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class ViewShareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        View::share([
            LocaleService::PARAMETER_LOCALE => App::getLocale(),
        ]);

        return $next($request);
    }
}
