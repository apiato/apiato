<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindPermissionController extends ApiController
{
    public function __invoke(FindPermissionRequest $request, FindPermissionAction $action): array
    {
        $permission = $action->run($request);

        return $this->transform($permission, PermissionAdminTransformer::class);
    }
}
