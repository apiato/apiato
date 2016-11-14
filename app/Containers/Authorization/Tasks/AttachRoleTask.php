<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;

/**
 * Class AttachRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachRoleTask extends Task
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
     * @param                                  $role
     */
    public function run(User $user, $role)
    {
        return $user->attachRole($this->roleRepository->findWhere(['name' => $role])->first());
    }

}
