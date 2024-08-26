<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListUserRolesController extends ApiController
{
    public function __invoke(ListUserRolesRequest $request, ListUserRolesAction $action): array
    {
        $roles = $action->run($request);

        return $this->transform($roles, RoleAdminTransformer::class);
    }
}
