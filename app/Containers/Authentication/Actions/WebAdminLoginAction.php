<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;

class WebAdminLoginAction extends Action
{
    public function run(LoginRequest $data): Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginSubAction', [$data]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
