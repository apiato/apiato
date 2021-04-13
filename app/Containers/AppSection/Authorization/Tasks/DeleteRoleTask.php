<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteRoleTask extends Task
{
    protected RoleRepository $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Integer|Role $role
     *
     * @return bool
     * @throws DeleteResourceFailedException
     */
    public function run($role): bool
    {
        if ($role instanceof Role) {
            $role = $role->id;
        }

        // delete the record from the roles table.
        try {
            return $this->repository->delete($role);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
