<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Action\Abstracts\Action;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\AssignUserToRoleTask
     */
    private $assignUserToRoleTask;

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\RoleRepository
     */
    private $roleRepository;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * @var  \App\Containers\Authorization\Tasks\GetRoleTask
     */
    private $getRoleTask;

    /**
     * AssignUserToRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     * @param \App\Containers\User\Tasks\FindUserByIdTask                    $findUserByIdTask
     */
    public function __construct(
        AssignUserToRoleTask $assignUserToRoleTask,
        RoleRepository $roleRepository,
        FindUserByIdTask $findUserByIdTask,
        GetRoleTask $getRoleTask
    ) {
        $this->assignUserToRoleTask = $assignUserToRoleTask;
        $this->roleRepository = $roleRepository;
        $this->findUserByIdTask = $findUserByIdTask;
        $this->getRoleTask = $getRoleTask;
    }


    /**
     * @param $user
     * @param $rolesIds
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($user, $rolesIds)
    {
        if (!$user instanceof User) {
            $user = $this->findUserByIdTask->run($user);
        }

        if (!is_array($rolesIds)) {
            $rolesIds = [$rolesIds];
        }

        foreach ($rolesIds as $roleId) {
            $roles[] = $this->getRoleTask->run($roleId);
        }

        return $this->assignUserToRoleTask->run($user, $roles);
    }
}
