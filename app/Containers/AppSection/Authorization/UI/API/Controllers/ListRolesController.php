<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListRolesController extends ApiController
{
    public function __invoke(ListRolesRequest $request, ListRolesAction $action): array
    {
        $roles = $action->run();

        return $this->transform($roles, RoleTransformer::class);
    }
}
