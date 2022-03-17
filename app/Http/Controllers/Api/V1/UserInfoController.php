<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function __invoke(Request $request): User
    {
        return $request->user();
    }
}
