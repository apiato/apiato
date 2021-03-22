<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\LoginTransporter;
use App\Containers\Authentication\Exceptions\UserNotConfirmedException;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginSubAction extends SubAction
{
    public function run(LoginTransporter $data): Authenticatable
    {
        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$data->toArray()]);

        $requestData = [
            'username' => $loginCustomAttribute['username'],
            'password' => $data->password,
            'remember_me' => $data->remember_me,
            'loginCustomAttribute' => $loginCustomAttribute['loginAttribute']
        ];

        $user = Apiato::call('Authentication@LoginTask', [$requestData['username'], $requestData['password'], $requestData['loginCustomAttribute'], $requestData['remember_me']]);
        $isUserConfirmed = Apiato::call('Authentication@CheckIfUserEmailIsConfirmedTask', [$user]);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
