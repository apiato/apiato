<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindPermissionByIdController extends ApiController
{
    public function __invoke(FindPermissionByIdRequest $request, FindPermissionByIdAction $action): array
    {
        $permission = $action->run($request);

        return $this->transform($permission, PermissionAdminTransformer::class);
    }
}
