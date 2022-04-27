<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\Auth;

class LoginTask extends ParentTask
{
    public function run(string $username, string $password, string $field = 'email', bool $remember = false): bool
    {
        return Auth::guard('web')->attempt([$field => $username, 'password' => $password], $remember);
    }
}
