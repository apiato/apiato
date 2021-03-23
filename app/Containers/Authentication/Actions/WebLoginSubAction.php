<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginSubAction extends SubAction
{
    public function run(LoginRequest $data): Authenticatable
    {
        $sanitizedData = $data->sanitizeInput([
            'email',
            'password',
            'remember_me' => false
        ]);

        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$sanitizedData]);

        $user = Apiato::call('Authentication@LoginTask', [
            $loginCustomAttribute['username'],
            $sanitizedData['password'],
            $loginCustomAttribute['loginAttribute'],
            $sanitizedData['remember_me']
        ]);

        $isUserConfirmed = Apiato::call('Authentication@CheckIfUserEmailIsConfirmedTask', [$user]);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
