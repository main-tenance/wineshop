<?php


namespace App\Http\Controllers\Cms;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CmsBaseController
{
    public function getCurrentUser(): User
    {
        $user = Auth::user();
        if (!$user) {
            abort(401);
        }

        return $user;
    }

}
