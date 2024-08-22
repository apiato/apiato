<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindPermissionByIdAction extends ParentAction
{
    public function __construct(
        private readonly PermissionRepository $repository,
    ) {
    }

    public function run(FindPermissionByIdRequest $request): Permission
    {
        return $this->repository->getById($request->permission_id);
    }
}
