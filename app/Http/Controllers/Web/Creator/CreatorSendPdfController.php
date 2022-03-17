<?php

namespace App\Http\Controllers\Web\Creator;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use App\Services\Creators\CreatorsService;

class CreatorSendPdfController extends Controller
{
    public function __invoke(Creator $creator)
    {
        $this->getCreatorsService()->sendPdfCatalog(request()->user(), $creator);

        return response()->json(['message' => __('creators.send-pdf-catalog.message')]);
    }

    public function getCreatorsService(): CreatorsService
    {
        return app(CreatorsService::class);
    }
}
