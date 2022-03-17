<?php


namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateFormRequest;
use App\Models\User;
use App\Policies\Permission;
use App\Services\Users\UsersService;
use Illuminate\Http\JsonResponse;

class UserUpdateController extends Controller
{
    public function __invoke(User $user, UserUpdateFormRequest $request): JsonResponse
    {
        $this->authorize(Permission::UPDATE, $user);
        $usersService = app(UsersService::class);
        $usersService->updateUser($user, $request->getFormData());

        return response()->json(['ok' => 1, 'message' => __('app.info_saved')]);
    }

}
