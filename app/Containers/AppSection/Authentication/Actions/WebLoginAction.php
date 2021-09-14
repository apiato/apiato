<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginAction extends Action
{
    /**
     * @throws UserNotConfirmedException
     * @throws LoginFailedException
     * @throws NotFoundException
     */
    public function run(LoginRequest $request): User|Authenticatable|null
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => false,
        ]);

        $loginCustomAttribute = app(ExtractLoginCustomAttributeTask::class)->run($sanitizedData);

        $loggedIn = app(LoginTask::class)->run(
            $loginCustomAttribute['username'],
            $sanitizedData['password'],
            $loginCustomAttribute['loginAttribute'],
            $sanitizedData['remember_me']
        );

        if (!$loggedIn) {
            throw new LoginFailedException('Invalid Login Credentials.');
        }

        $user = app(GetAuthenticatedUserTask::class)->run();
        $this->processEmailConfirmation($user);

        return $user;
    }

    /**
     * @throws UserNotConfirmedException
     */
    private function processEmailConfirmation(User $user): void
    {
        $userConfirmed = app(CheckIfUserEmailIsConfirmedTask::class)->run($user);

        if (!$userConfirmed) {
            throw new UserNotConfirmedException();
        }
    }
}
