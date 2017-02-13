<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Task\Abstracts\Task;

/**
 * Class RevokeUserFromRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleTask extends Task
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
     * @param \App\Containers\User\Models\User $user | $userId
     * @param                                  $roles
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($user, $roles)
    {
        if (!$user instanceof User) {
            $user = $this->findUserByIdTask->run($user);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                $this->removeRole($user, $role);
            }

        } else {
            $this->removeRole($user, $roles);
        }

        return $user;
    }

    /**
     * @param $user
     * @param $role
     *
     * @return  mixed
     */
    private function removeRole($user, $role)
    {
        $user = $user->removeRole($this->roleRepository->findWhere(['name' => $role])->first());

        return $user;
    }

}
