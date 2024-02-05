<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListRolePermissionsController extends ApiController
{
    public function __invoke(ListRolePermissionsRequest $request, ListRolePermissionsAction $action): array
    {
        $permissions = $action->run($request);

        return $this->transform($permissions, PermissionAdminTransformer::class);
    }
}
