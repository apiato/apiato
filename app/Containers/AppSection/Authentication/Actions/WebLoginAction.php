<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
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

        $loginCustomAttribute = Apiato::call(ExtractLoginCustomAttributeTask::class, [$sanitizedData]);

        $isSuccessful = Apiato::call(LoginTask::class, [
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

        $isUserConfirmed = Apiato::call(CheckIfUserEmailIsConfirmedTask::class, [$user]);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
