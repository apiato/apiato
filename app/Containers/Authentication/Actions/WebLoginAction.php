<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginAction extends Action
{
    public function run(LoginRequest $data): Authenticatable
    {
        return Apiato::call('Authentication@WebLoginSubAction', [$data]);
    }
}
