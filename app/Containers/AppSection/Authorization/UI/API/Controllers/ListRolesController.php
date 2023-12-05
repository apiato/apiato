<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListRolesController extends ApiController
{
    public function __construct(
        private readonly ListRolesAction $listRolesAction
    ) {
    }

    public function __invoke(ListRolesRequest $request): array
    {
        $roles = $this->listRolesAction->run();

        return $this->transform($roles, RoleTransformer::class);
    }
}
