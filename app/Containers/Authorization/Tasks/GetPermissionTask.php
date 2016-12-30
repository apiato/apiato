<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class GetPermissionTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetPermissionTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\PermissionRepository
     */
    private $permissionRepository;

    /**
     * GetAdminPermissionTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $permissionName
     *
     * @return  mixed
     */
    public function run($permissionName)
    {
        return $this->permissionRepository->findWhere(['name' => $permissionName])->first();
    }

}
