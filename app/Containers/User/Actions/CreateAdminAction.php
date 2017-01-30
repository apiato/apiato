<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\User\Tasks\FireUserCreatedEventTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserByCredentialsTask
     */
    private $createUserByCredentialsTask;

    /**
     * @var  \App\Containers\User\Actions\FireUserCreatedEventTask
     */
    private $fireUserCreatedEventTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\AssignRoleTask
     */
    private $assignRoleTask;

    /**
     * CreateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\CreateUserByCredentialsTask $createUserByCredentialsTask
     * @param \App\Containers\User\Tasks\FireUserCreatedEventTask    $fireUserCreatedEventTask
     * @param \App\Containers\Authorization\Tasks\AssignRoleTask     $assignRoleTask
     */
    public function __construct(
        CreateUserByCredentialsTask $createUserByCredentialsTask,
        FireUserCreatedEventTask $fireUserCreatedEventTask,
        AssignRoleTask $assignRoleTask
    ) {
        $this->createUserByCredentialsTask = $createUserByCredentialsTask;
        $this->fireUserCreatedEventTask = $fireUserCreatedEventTask;
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
