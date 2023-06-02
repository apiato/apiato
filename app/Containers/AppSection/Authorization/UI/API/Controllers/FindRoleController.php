<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindRoleController extends ApiController
{
    public function __construct(
        private readonly FindRoleAction $findRoleAction
    ) {
    }

    public function __invoke(FindRoleRequest $request): array
    {
        $role = $this->findRoleAction->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
