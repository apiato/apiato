<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action as ParentAction;

final class FindPermissionByIdAction extends ParentAction
{
    public function __construct(
        private readonly PermissionRepository $repository,
    ) {
    }

    public function run(int $id): Permission
    {
        return $this->repository->findOrFail($id);
    }
}
