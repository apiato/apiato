<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class GetAdminRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAdminRoleTask extends Task
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
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run()
    {
        return $this->roleRepository->findWhere(['name' => 'admin'])->first();
    }

}
