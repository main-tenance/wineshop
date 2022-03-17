<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CheckAgeMiddleware
{
    const MIN_AGE = 18;

    public function handle(Request $request, Closure $next, int $minAge = self::MIN_AGE)
    {
        View::share([
            'age' => (int)$request->cookie('age'),
            'minAge' => $minAge,
        ]);

        return $next($request);
    }
}
