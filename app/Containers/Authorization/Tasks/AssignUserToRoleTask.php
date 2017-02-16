<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Task\Abstracts\Task;

/**
 * Class AssignUserToRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\RoleRepository
     */
    private $roleRepository;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * AssignUserToRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     * @param \App\Containers\User\Tasks\FindUserByIdTask                    $findUserByIdTask
     */
    public function __construct(RoleRepository $roleRepository, FindUserByIdTask $findUserByIdTask)
    {
        $this->roleRepository = $roleRepository;
        $this->findUserByIdTask = $findUserByIdTask;
    }

    /**
     * @param $user
     * @param $rolesIds
     *
     * @return  mixed|\Spatie\Permission\Contracts\Role
     */
    public function run($user, $rolesIds)
    {
        if (!$user instanceof User) {
            $user = $this->findUserByIdTask->run($user);
        }

        if (!is_array($rolesIds)) {
            $rolesIds = [$rolesIds];
        }

        // TODO: run 1 query to get them all, let a task do that and call it from the action before (passing roles as param here)
        foreach ($rolesIds as $roleId) {
            $roles[] = $this->roleRepository->findWhere(['id' => $roleId])->first();
        }

        $user = $user->assignRole($roles);

        return $user;
    }

}
