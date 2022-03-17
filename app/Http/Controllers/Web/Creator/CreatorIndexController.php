<?php


namespace App\Http\Controllers\Web\Creator;

use App\Http\Controllers\Controller;
use App\Services\Creators\CreatorsService;
use Illuminate\Support\Facades\View;

class CreatorIndexController extends Controller
{
    public function __invoke(CreatorsService $service)
    {
        $creators = $service->getAllSortedCreators();
        View::share(['creators' => $creators]);

        return view('creators.index');
    }
}
