<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateAdminAction extends ParentAction
{
    /**
     * @param array $data
     * @return User
     * @throws CreateResourceFailedException
     * @throws Throwable
     * @throws NotFoundException
     */
    public function run(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = app(CreateUserByCredentialsTask::class)->run($data);
            $adminRoleName = config('appSection-authorization.admin_role');
            foreach (array_keys(config('auth.guards')) as $guardName) {
                $adminRole = app(FindRoleTask::class)->run($adminRoleName, $guardName);
                app(AssignRolesToUserTask::class)->run($user, $adminRole);
            }
            $user->email_verified_at = now();
            $user->save();

            return $user;
        });
    }
}
