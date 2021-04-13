<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task;

class FindPermissionTask extends Task
{
    protected PermissionRepository $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($permissionNameOrId): Permission
    {
        $query = is_numeric($permissionNameOrId) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];

        return $this->repository->findWhere($query)->first();
    }
}
