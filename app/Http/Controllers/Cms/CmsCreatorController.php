<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\Creators\CreateCreatorFormRequest;
use App\Http\Requests\Cms\Creators\UpdateCreatorFormRequest;
use App\Models\Creator;
use App\Policies\Permission;
use App\Services\Creators\CreatorsService;
use App\Services\Creators\Forms\CmsCreatorCreateFormBuilder;
use App\Services\Creators\Forms\CmsCreatorEditFormBuilder;
use App\Services\Creators\Menus\CmsCreatorsPageMenuBuilder;
use App\Services\Creators\Tables\CmsCreatorsTableBuilder;
use App\Http\Routes\Cms\CmsRoutesProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;

class CmsCreatorController extends Controller
{

    public function getCreatorsService()
    {
        return app(CreatorsService::class);
    }

    public function getCmsCreatorsTable()
    {
        return app(CmsCreatorsTableBuilder::class);
    }

    public function getCmsCreatorCreateForm()
    {
        return app(CmsCreatorCreateFormBuilder::class);
    }

    public function getCmsCreatorEditForm()
    {
        return app(CmsCreatorEditFormBuilder::class);
    }

    public function getCmsCreatorsMenu()
    {
        return app(CmsCreatorsPageMenuBuilder::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Permission::VIEW_ANY, Creator::class);
        $table = $this->getCmsCreatorsTable();
        $pageMenu = $this->getCmsCreatorsMenu();
        View::share([
            'table' => $table,
            'pageMenu' => $pageMenu,
            'url' => CmsRoutesProvider::creatorIndex(),
        ]);
        if (request()->expectsJson()) {
            return response()->json([
                'html' => view('table.list')->render(),
                'pagination' => view('table.pagination-inner')->render(),
                'pagecount' => $table->getPageCount(),
                'pageid' => $table->getPageId(),
            ]);
        }

        return view('cms.creators.index');
    }

    public function create()
    {
        $this->authorize(Permission::CREATE, Creator::class);
        $pageMenu = $this->getCmsCreatorsMenu();
        $form = $this->getCmsCreatorCreateForm();
        View::share([
            'form' => $form,
            'url' => CmsRoutesProvider::creatorStore(),
            'pageMenu' => $pageMenu
        ]);

        return view('cms.creators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCreatorFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateCreatorFormRequest $request)
    {
        $this->authorize(Permission::CREATE, Creator::class);
        $creator = $this->getCreatorsService()->createCreator($request->getFormData());

        return response()->json(['ok' => 1, 'id' => $creator->id]);
    }


    public function edit(Creator $creator)
    {
        $this->authorize(Permission::UPDATE, $creator);
        $pageMenu = $this->getCmsCreatorsMenu();
        $form = $this->getCmsCreatorEditForm();
        View::share([
            'model' => $creator,
            'form' => $form,
            'url' => CmsRoutesProvider::creatorUpdate($creator),
            'pageMenu' => $pageMenu,
        ]);

        return view('cms.creators.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCreatorFormRequest $request
     * @param Creator $creator
     * @return JsonResponse
     */
    public function update(Creator $creator, UpdateCreatorFormRequest $request)
    {
        $this->authorize(Permission::UPDATE, $creator);
        $this->getCreatorsService()->updateCreator($creator, $request->getFormData());

        return response()->json(['ok' => 1, 'message' => __('app.info_saved')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Creator $creator
     * @return JsonResponse
     */
    public function destroy(Creator $creator)
    {
        $this->authorize(Permission::DELETE, $creator);
        $this->getCreatorsService()->destroy($creator);

        return response()->json(['ok' => 1]);
    }
}
