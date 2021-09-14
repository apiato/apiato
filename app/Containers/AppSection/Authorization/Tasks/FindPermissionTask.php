<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Str;

class FindPermissionTask extends Task
{
    public function __construct(
        protected PermissionRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($permissionNameOrId): Permission
    {
        $query = (is_numeric($permissionNameOrId) || Str::isUuid($permissionNameOrId)) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];
        $permission = $this->repository->findWhere($query)->first();

        return $permission ?? throw new NotFoundException();
    }
}
