<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser(array $attributes): User
    {
        return User::factory()->create($attributes);
    }
}
