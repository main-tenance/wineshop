<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VineRequest;
use App\Http\Resources\VineResource;
use App\Http\Resources\VinesResource;
use App\Models\Vine;
use App\Policies\Permission;
use App\Services\Vines\VinesService;
use Illuminate\Http\JsonResponse;

class VineController extends Controller
{
    public function getVinesService(): VinesService
    {
        return app(VinesService::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return VinesResource
     */
    public function index(): VinesResource
    {
        $vines = $this->getVinesService()->getAll();

        return new VinesResource($vines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VineRequest $request
     * @return VineResource
     */
    public function store(VineRequest $request): VineResource
    {
        $this->authorize(Permission::CREATE, Vine::class);
        $vine = $this->getVinesService()->store($request->getFormData());

        return new VineResource($vine);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vine $vine
     * @return VineResource
     */
    public function show(Vine $vine): VineResource
    {
        return new VineResource($vine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VineRequest $request
     * @param \App\Models\Vine $vine
     * @return VineResource
     */
    public function update(VineRequest $request, Vine $vine): VineResource
    {
        $this->authorize(Permission::UPDATE, $vine);
        $vine = $this->getVinesService()->update($vine, $request->getFormData());

        return new VineResource($vine);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vine $vine
     * @return JsonResponse
     */
    public function destroy(Vine $vine): JsonResponse
    {
        $this->authorize(Permission::DELETE, $vine);
        $this->getVinesService()->delete($vine);

        return response()->json(['status' => 'ok']);
    }
}
