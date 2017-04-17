<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Actions\Action;
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
        $admin = $this->call(CreateUserByCredentialsTask::class, [$request->email, $request->password, $request->name]);

        $this->call(AssignUserToRoleTask::class, [$admin, ['admin']]);

        return $admin;
    }
}
