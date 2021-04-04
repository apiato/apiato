<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends Action
{
    public function run(LoginRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => true
        ]);

        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$sanitizedData]);

        $isSuccessful = Apiato::call('Authentication@LoginTask', [
            $loginCustomAttribute['username'],
            $sanitizedData['password'],
            $loginCustomAttribute['loginAttribute'],
            $sanitizedData['remember_me']
        ]);

        $user = null;
        if ($isSuccessful) {
            $user = Auth::user();
        } else {
            throw new LoginFailedException();
        }

        $isUserConfirmed = Apiato::call('Authentication@CheckIfUserEmailIsConfirmedTask', [$user]);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
