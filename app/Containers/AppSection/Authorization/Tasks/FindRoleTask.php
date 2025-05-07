<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Str;

final class FindRoleTask extends ParentTask
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    public function run(string|int $nameOrId, string $guardName = 'api'): Role
    {
        $query = [
            'guard_name' => $guardName,
        ];

        if ($this->isId($nameOrId)) {
            $query['id'] = $nameOrId;
        } else {
            $query['name'] = $nameOrId;
        }

        return $this->repository->findWhere($query)->sole();
    }

    private function isId(int|string $roleNameOrId): bool
    {
        return is_numeric($roleNameOrId) || Str::isUuid($roleNameOrId) || Str::isUlid($roleNameOrId);
    }
}
