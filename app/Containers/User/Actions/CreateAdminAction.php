<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Port\Action\Abstracts\Action;

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
     * @var  \App\Containers\Authorization\Tasks\AssignRoleTask
     */
    private $assignRoleTask;

    /**
     * CreateAdminAction constructor.
     *
     * @param \App\Containers\User\Tasks\CreateUserByCredentialsTask $createUserByCredentialsTask
     * @param \App\Containers\Authorization\Tasks\AssignRoleTask     $assignRoleTask
     */
    public function __construct(
        CreateUserByCredentialsTask $createUserByCredentialsTask,
        AssignRoleTask $assignRoleTask
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
