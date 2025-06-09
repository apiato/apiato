<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class CreatePermissionTask extends ParentTask
{
    public function __construct(
        private readonly PermissionRepository $repository,
    ) {
    }

    public function run(string $name, null|string $description = null, null|string $displayName = null, string $guardName = 'api'): Permission
    {
        return $this->repository->create([
            'name'         => strtolower($name),
            'description'  => $description,
            'display_name' => $displayName,
            'guard_name'   => $guardName,
        ]);
    }
}
