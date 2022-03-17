<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        Cache::remember('banner', 600, function () {
            return view('main.banner')->render();
        });
        Cache::rememberForever('benefits', function () {
            return view('main.benefits')->render();
        });
        Cache::remember('categories', 600, function () {
            return view('main.categories')->render();
        });

        return view('main.index');
    }
}
