<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Task\Abstracts\Task;

/**
 * Class AssignRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignRoleTask extends Task
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
     * AssignRoleTask constructor.
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
        if(!$user instanceof User){
            $user = $this->findUserByIdTask->run($user);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                $this->assignRole($user, $role);
            }

        }else{
            $this->assignRole($user, $roles);
        }

        return $user;
    }

    /**
     * @param $user
     * @param $role
     *
     * @return  mixed
     */
    private function assignRole($user, $role)
    {
        return $user->assignRole($this->roleRepository->findWhere(['name' => $role])->first());
    }

}
