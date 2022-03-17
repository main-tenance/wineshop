<?php


namespace App\Http\Controllers\Web\Creator;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use Illuminate\Support\Facades\View;

class CreatorShowController extends Controller
{
    public function __invoke(Creator $creator)
    {
        if (!$creator) {
            abort(404);
        }

        View::share(['creator' => $creator]);

        return view('creators.show');
    }
}
