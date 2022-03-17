<?php

namespace App\Http\Middleware;

use App\Services\Locale\LocaleService;
use Closure;
use Illuminate\Http\Request;

class LocalizeMiddleware
{
    private $localeService;

    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route()->parameter(LocaleService::PARAMETER_LOCALE);

        if (!$this->localeService->isSupportedLocale($locale)) {
            $params = $request->route()->parameters();
            $params[LocaleService::PARAMETER_LOCALE] = env('APP_LOCALE');

            return redirect(route($request->route()->getName(), $params));
        }

        $this->localeService->localize($locale);
        $request->route()->forgetParameter(LocaleService::PARAMETER_LOCALE);

        return $next($request);
    }
}
