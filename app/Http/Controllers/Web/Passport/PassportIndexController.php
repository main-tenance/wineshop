<?php

namespace App\Http\Controllers\Web\Passport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PassportIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        return view('passport.index');
    }
}
