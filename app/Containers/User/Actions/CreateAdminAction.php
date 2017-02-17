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
     * @var  \App\Containers\User\Tasks\CreateUserByCredentialsTask
     */
    private $createUserByCredentialsTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\AssignUserToRoleTask
     */
    private $assignRoleTask;

    /**
     * CreateAdminAction constructor.
     *
     * @param \App\Containers\User\Tasks\CreateUserByCredentialsTask $createUserByCredentialsTask
     * @param \App\Containers\Authorization\Tasks\AssignUserToRoleTask     $assignRoleTask
     */
    public function __construct(
        CreateUserByCredentialsTask $createUserByCredentialsTask,
        AssignUserToRoleTask $assignRoleTask
    ) {
        $this->createUserByCredentialsTask = $createUserByCredentialsTask;
        $this->assignRoleTask = $assignRoleTask;
    }

    /**
     * @param $email
     * @param $password
     * @param $name
     *
     * @return  mixed
     */
    public function run($email, $password, $name)
    {
        $admin = $this->createUserByCredentialsTask->run($email, $password, $name);

        $this->assignRoleTask->run($admin, ['admin']);

        return $admin;
    }
}
