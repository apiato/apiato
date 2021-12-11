<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
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

            $admin = app(CreateUserByCredentialsTask::class)->run($data);
            app(AssignRolesToUserTask::class)->run($admin, [config('appSection-authorization.admin_role')]);
            $admin->email_verified_at = now();
            $admin->save();

            DB::commit();

            return $admin;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
