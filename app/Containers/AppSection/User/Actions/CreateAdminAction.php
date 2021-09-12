<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;

class CreateAdminAction extends Action
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(CreateAdminRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'name',
            'gender',
            'birth',
        ]);

        $admin = app(CreateUserByCredentialsTask::class)->run($sanitizedData, isAdmin: true);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_admin=true`).
        app(AssignRolesToUserTask::class)->run($admin, ['admin']);

        return $admin;
    }
}
