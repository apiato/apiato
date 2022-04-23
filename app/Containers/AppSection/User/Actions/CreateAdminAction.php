<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateAdminAction extends Action
{
    /**
     * @throws CreateResourceFailedException
     * @throws Throwable
     */
    public function run(array $data): User
    {
        try {
            DB::beginTransaction();

            $user = app(CreateUserByCredentialsTask::class)->run($data);
            $adminRoleName = config('appSection-authorization.admin_role');
            foreach (array_keys(config('auth.guards')) as $guardName) {
                $adminRole = app(FindRoleTask::class)->run($adminRoleName, $guardName);
                app(AssignRolesToUserTask::class)->run($user, $adminRole);
            }
            $user->email_verified_at = now();
            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
