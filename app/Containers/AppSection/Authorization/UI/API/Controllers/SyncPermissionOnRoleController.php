<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class SyncPermissionOnRoleController extends ApiController
{
    public function __construct(
        private readonly SyncPermissionsOnRoleAction $syncPermissionsOnRoleAction
    ) {
    }

    public function __invoke(SyncPermissionsOnRoleRequest $request): array
    {
        $role = $this->syncPermissionsOnRoleAction->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
