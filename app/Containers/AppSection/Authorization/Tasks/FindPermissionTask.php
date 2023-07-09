<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Str;

class FindPermissionTask extends ParentTask
{
    public function __construct(
        protected readonly PermissionRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(string|int $permissionNameOrId, string $guardName = 'api'): Permission
    {
        $query = [
            'guard_name' => $guardName,
        ];

        if ($this->isID($permissionNameOrId)) {
            $query['id'] = $permissionNameOrId;
        } else {
            $query['name'] = $permissionNameOrId;
        }

        $permission = $this->repository->findWhere($query)->first();

        return $permission ?? throw new NotFoundException();
    }

    private function isID(int|string $permissionNameOrId): bool
    {
        return is_numeric($permissionNameOrId) || Str::isUuid($permissionNameOrId);
    }
}
