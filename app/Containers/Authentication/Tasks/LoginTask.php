<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class LoginTask extends Task
{
    public function run(string $username, string $password, string $field = 'email', bool $remember = false): Authenticatable
    {
        if (!Auth::attempt([$field => $username, 'password' => $password], $remember)) {
            throw new LoginFailedException();
        }

        return Auth::user();
    }
}
