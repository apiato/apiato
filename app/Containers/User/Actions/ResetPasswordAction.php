<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

class ResetPasswordAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'email' => $request->email,
            'token' => $request->token,
            'password' => $request->password,
            'password_confirmation' => $request->password,
        ];

        Apiato::call('User@ResetPasswordTask', [$data]);

    }
}
