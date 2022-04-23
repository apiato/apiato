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
        protected PermissionRepository $repository
    ) {
    }

    /**
     * @param string|int $permissionNameOrId
     * @param string $guardName
     * @return Permission
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

    /**
     * @param int|string $permissionNameOrId
     * @return bool
     */
    private function isID(int|string $permissionNameOrId): bool
    {
        return (is_numeric($permissionNameOrId) || Str::isUuid($permissionNameOrId));
    }
}
