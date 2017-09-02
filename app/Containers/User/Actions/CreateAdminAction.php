<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $admin = $this->call(CreateUserByCredentialsTask::class, [
            $isClient = false,
            $request->email,
            $request->password,
            $request->name
        ]);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_client=false`).
        $this->call(AssignUserToRoleTask::class, [$admin, ['admin']]);

        return $admin;
    }
}
