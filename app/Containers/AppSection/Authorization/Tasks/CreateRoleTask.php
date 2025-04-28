<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateRoleTask extends ParentTask
{
    public function __construct(private readonly RoleRepository $repository)
    {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(string $name, null|string $description = null, null|string $displayName = null, string $guardName = 'api'): Role
    {
        try {
            $role = $this->repository->create([
                'name'         => strtolower($name),
                'description'  => $description,
                'display_name' => $displayName,
                'guard_name'   => $guardName,
            ]);
        } catch (\Throwable) {
            throw new CreateResourceFailedException();
        }

        return $role;
    }
}
