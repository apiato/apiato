<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Task\Abstracts\Task;

/**
 * Class ListAllPermissionsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllPermissionsTask extends Task
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
     * @return  mixed
     */
    public function run()
    {
        return $this->permissionRepository->all();
    }

}
