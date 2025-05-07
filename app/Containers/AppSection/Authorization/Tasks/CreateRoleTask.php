<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class CreateRoleTask extends ParentTask
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    public function run(string $name, string|null $description = null, string|null $displayName = null, string $guardName = 'api'): Role
    {
        return $this->repository->create([
            'name' => strtolower($name),
            'description' => $description,
            'display_name' => $displayName,
            'guard_name' => $guardName,
        ]);
    }
}
