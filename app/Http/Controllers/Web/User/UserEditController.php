<?php


namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Routes\Web\WebRoutesProvider;
use App\Policies\Permission;
use App\Services\Users\Forms\UpdateUserForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserEditController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user = $user->id ? $user : $request->user();
        $this->authorize(Permission::UPDATE, $user);
        $form = app(UpdateUserForm::class);
        View::share([
            'form' => $form,
            'model' => $user,
            'url' => WebRoutesProvider::userUpdate($user),
        ]);

        return view('user.edit');
    }
}
