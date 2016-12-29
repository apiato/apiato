<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\User\Models\User;
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
     * GetAdminRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $roles
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(User $user, $roles)
    {
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
