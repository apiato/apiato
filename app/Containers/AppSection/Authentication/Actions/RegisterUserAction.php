<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Ship\Exceptions\ResourceCreationFailed;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Auth\Events\Registered;

class RegisterUserAction extends ParentAction
{
    public function __construct(
        private readonly CreateUserTask $createUserTask,
    ) {
    }

    /**
     * @throws ResourceCreationFailed
     */
    public function run(RegisterUserRequest $request): User
    {
        $sanitizedData = $request->sanitize([
            'email',
            'password',
            'name',
            'gender',
            'birth',
        ]);

        $user = $this->createUserTask->run($sanitizedData);

        event(new Registered($user));

        return $user;
    }
}
