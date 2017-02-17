<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use App\Ship\Action\Abstracts\Action;

/**
 * Class DeleteRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleTask extends Action
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\RoleRepository
     */
    private $roleRepository;

    /**
     * DeleteRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Integer|Role $role
     *
     * @return  bool
     */
    public function run($role)
    {
        if ($role instanceof Role) {
            $role = $role->id;
        }

        // delete the record from the roles table.
        return $this->roleRepository->delete($role);
    }
}
