<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetRoleTask extends Task
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
     * @param Integer|String $roleNameOrId
     *
     * @return  mixed
     */
    public function run($roleNameOrId)
    {
        $query = ['id' => $roleNameOrId];

        if (!is_numeric($roleNameOrId)) {
            $query = ['name' => $roleNameOrId];
        }

        return $this->roleRepository->findWhere($query)->first();
    }

}
