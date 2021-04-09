<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

class LoginTask extends Task
{
    public function run(string $username, string $password, string $field = 'email', bool $remember = false): bool
    {
        return Auth::attempt([$field => $username, 'password' => $password], $remember);
    }
}
