<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
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
    public function run(CreateAdminRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'name',
            'gender',
            'birth',
        ]);

        DB::beginTransaction();

        try {
            $admin = app(CreateUserByCredentialsTask::class)->run($sanitizedData);
            app(AssignRolesToUserTask::class)->run($admin, [config('appSection-authorization.admin_role')]);

            DB::commit();

            return $admin;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
