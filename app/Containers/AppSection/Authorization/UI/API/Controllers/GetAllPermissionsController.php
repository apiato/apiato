<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllPermissionsController extends ApiController
{
    public function __construct(
        private readonly GetAllPermissionsAction $getAllPermissionsAction
    ) {
    }

    public function __invoke(GetAllPermissionsRequest $request): array
    {
        $permissions = $this->getAllPermissionsAction->run();

        return $this->transform($permissions, PermissionTransformer::class);
    }
}
