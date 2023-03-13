<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
    public static function register(array $data): User
    {
        // should probably validate data here

        return User::create($data);
    }

    public static function showProfile(): array|null
    {
        if (auth()->user()) {
            // should probably use API resources instead
            return [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address,
            ];
        }

        return null;
    }

    public static function updateProfile($data): void
    {
        if (!auth()->user()) {
            abort(403);
        }

        // should probably validate data here

        auth()->user()->update($data);
    }
}
