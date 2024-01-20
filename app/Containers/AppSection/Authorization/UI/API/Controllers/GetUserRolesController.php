<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetUserRolesController extends ApiController
{
    public function __invoke(GetUserRolesRequest $request, GetUserRolesAction $action): array
    {
        $roles = $action->run($request);

        return $this->transform($roles, RoleTransformer::class);
    }
}
