<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListUserPermissionsController extends ApiController
{
    public function __invoke(ListUserPermissionsRequest $request, ListUserPermissionsAction $action): array
    {
        $permissions = $action->run($request);

        return $this->transform($permissions, PermissionAdminTransformer::class);
    }
}
