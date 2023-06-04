<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetUserPermissionsController extends ApiController
{
    public function __construct(
        private readonly GetUserPermissionsAction $getUserPermissionsAction
    ) {
    }

    public function __invoke(GetUserPermissionsRequest $request): array
    {
        $permission = $this->getUserPermissionsAction->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
