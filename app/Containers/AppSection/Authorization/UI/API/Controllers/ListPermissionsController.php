<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListPermissionsController extends ApiController
{
    public function __invoke(ListPermissionsRequest $request, ListPermissionsAction $action): array
    {
        $permissions = $action->run();

        return $this->transform($permissions, PermissionAdminTransformer::class);
    }
}
