<?php

namespace App\Containers\AppSection\Authentication\Actions;

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

        $loginCustomAttribute = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);

        $isSuccessful = app(LoginTask::class)->run(
            $loginCustomAttribute['username'],
            $sanitizedData['password'],
            $loginCustomAttribute['loginAttribute'],
            $sanitizedData['remember_me']
        );

        $user = null;
        if ($isSuccessful) {
            $user = Auth::user();
        } else {
            throw new LoginFailedException();
        }

        $isUserConfirmed = app(CheckIfUserEmailIsConfirmedTask::class)->run($user);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}
