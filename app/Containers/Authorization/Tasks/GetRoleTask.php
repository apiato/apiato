<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Port\Task\Abstracts\Task;

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
     * @param $roleName
     *
     * @return  mixed
     */
    public function run($roleName)
    {
        return $this->roleRepository->findWhere(['name' => $roleName])->first();
    }

}
