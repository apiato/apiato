<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Str;

class FindRoleTask extends Task
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($roleNameOrId): Role
    {
        try {
            $query = (is_numeric($roleNameOrId) || Str::isUuid($roleNameOrId)) ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];
            $role = $this->repository->findWhere($query)->first();
        } catch (Exception) {
            throw new NotFoundException();
        }

        return $role;
    }
}
