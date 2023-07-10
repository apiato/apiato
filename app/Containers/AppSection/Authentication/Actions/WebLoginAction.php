<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends ParentAction
{
    public function __construct(
        private readonly LoginTask $loginTask
    ) {
    }

    /**
     * @throws LoginFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(LoginRequest $request): User|Authenticatable|null
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => false,
        ]);

        [$loginFieldValue, $loginFieldName] = LoginCustomAttribute::extract($sanitizedData);

        $loggedIn = $this->loginTask->run(
            $loginFieldValue,
            $sanitizedData['password'],
            $loginFieldName,
            $sanitizedData['remember_me']
        );

        if (!$loggedIn) {
            throw new LoginFailedException('Invalid Login Credentials.');
        }

        return Auth::user();
    }
}
