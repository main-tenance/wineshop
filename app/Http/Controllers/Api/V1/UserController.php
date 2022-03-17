<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateFormRequest;
use App\Http\Requests\User\UserUpdateFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Users\UsersService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function getUsersService(): UsersService
    {
        return app(UsersService::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateFormRequest $request
     * @return UserResource
     */
    public function store(UserCreateFormRequest $request): UserResource
    {
        $data = $request->getFormData();
        $user = $this->getUsersService()->storeUser($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateFormRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserUpdateFormRequest $request, User $user): UserResource
    {
        $data = $request->getFormData();
        $user = $this->getUsersService()->updateUser($user, $data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->getUsersService()->delete($user);

        return response()->json(['status' => 'ok']);
    }

}
