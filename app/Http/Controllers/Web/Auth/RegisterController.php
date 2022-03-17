<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateFormRequest;
use App\Http\Routes\Web\WebRoutesProvider;
use App\Providers\RouteServiceProvider;
use App\Services\Users\Forms\CreateUserForm;
use App\Services\Users\UsersService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{

    public function create()
    {
        $form = app(CreateUserForm::class);
        View::share([
            'form' => $form,
            'url' => WebRoutesProvider::userStore(),
        ]);

        return view('user.create');
    }

    public function createPopup()
    {
        $form = app(CreateUserForm::class);
        View::share([
            'form' => $form,
            'url' => WebRoutesProvider::userStore(),
        ]);

        return view('user.createPopup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param UserCreateFormRequest $request
     * @param UsersService $usersService
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserCreateFormRequest $request, UsersService $usersService)
    {
        $user = $usersService->storeUser($request->getFormData());
        event(new Registered($user));
        Auth::login($user);
        if ($request->expectsJson()) {
            return response()->json(['ok' => 1]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
