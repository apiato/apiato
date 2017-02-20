<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Tasks\SyncUserRolesTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class SyncUserRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncUserRolesAction extends Action
{

    /**
     * @var  \App\Containers\Authorization\Tasks\SyncUserRolesTask
     */
    private $syncUserRolesTask;

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
     * SyncUserRolesTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     * @param \App\Containers\User\Tasks\FindUserByIdTask                    $findUserByIdTask
     */
    public function __construct(
        SyncUserRolesTask $syncUserRolesTask,
        RoleRepository $roleRepository,
        FindUserByIdTask $findUserByIdTask,
        GetRoleTask $getRoleTask
    ) {
        $this->syncUserRolesTask = $syncUserRolesTask;
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

        return $this->syncUserRolesTask->run($user, $roles);
    }
}
