<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindPermissionController extends ApiController
{
    public function __construct(
        private readonly FindPermissionAction $findPermissionAction
    ) {
    }

    public function __invoke(FindPermissionRequest $request): array
    {
        $permission = $this->findPermissionAction->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
