<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetRolePermissionsController extends ApiController
{
    public function __construct(
        private readonly GetRolePermissionsAction $getRolePermissionsAction
    ) {
    }

    public function __invoke(GetRolePermissionsRequest $request): array
    {
        $permission = $this->getRolePermissionsAction->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
