<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    public function createUser($data)
    {
        return User::create($data);
    }
}