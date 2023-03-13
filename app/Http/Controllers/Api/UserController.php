<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateProfileRequest;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return UsersService::showProfile();
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        UsersService::updateProfile($request->validated());

        return response()->json('ok'); // could also return the updated profile instead
    }
}
