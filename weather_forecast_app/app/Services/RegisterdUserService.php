<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

// class RegisterdUserService extends BaseService
class RegisterdUserService
{
    public function registerUser(LoginRequest $request)
    {
        User::registerUser($request['otk'], $request);
    }
}
