<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{
    /**
     * @param $email
     * @param $password
     * @param $name
     *
     * @return  mixed
     */
    public function run($email, $password, $name)
    {
        $admin = $this->call(CreateUserByCredentialsTask::class, [$email, $password, $name]);

        $this->call(AssignUserToRoleTask::class, [$admin, ['admin']]);

        return $admin;
    }
}
