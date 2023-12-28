<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListPermissionsController extends ApiController
{
    public function __construct(
        private readonly ListPermissionsAction $listPermissionsAction,
    ) {
    }

    public function __invoke(ListPermissionsRequest $request): array
    {
        $permissions = $this->listPermissionsAction->run();

        return $this->transform($permissions, PermissionTransformer::class);
    }
}
