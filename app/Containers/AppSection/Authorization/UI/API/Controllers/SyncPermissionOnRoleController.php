<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class SyncPermissionOnRoleController extends ApiController
{
    public function __invoke(SyncPermissionsOnRoleRequest $request, SyncPermissionsOnRoleAction $action): array
    {
        $role = $action->run($request);

        return $this->transform($role, RoleAdminTransformer::class);
    }
}
