<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Task\Abstracts\Task;

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
     * @param $permissionNameOrId
     *
     * @return  mixed
     */
    public function run($permissionNameOrId)
    {
        $query = ['id' => $permissionNameOrId];

        if (!is_numeric($permissionNameOrId)) {
            $query = ['name' => $permissionNameOrId];
        }

        return $this->permissionRepository->findWhere($query)->first();
    }

}
