<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\Traits\LoginAttributeCaseSensitivityTrait;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends Action
{
    use LoginAttributeCaseSensitivityTrait;

    /**
     * @param LoginRequest $request
     * @return User|Authenticatable|null
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function run(LoginRequest $request): User|Authenticatable|null
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => false,
        ]);

        list($username, $loginAttribute) = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);

        $loggedIn = app(LoginTask::class)->run(
            $this->processLoginAttributeCaseSensitivity($username),
            $sanitizedData['password'],
            $loginAttribute,
            $sanitizedData['remember_me']
        );

        if (!$loggedIn) {
            throw new LoginFailedException('Invalid Login Credentials.');
        }

        return Auth::user();
    }
}
