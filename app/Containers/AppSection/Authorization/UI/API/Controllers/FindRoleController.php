<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindRoleController extends ApiController
{
    public function __invoke(FindRoleRequest $request, FindRoleAction $action): array
    {
        $role = $action->run($request);

        return $this->transform($role, RoleAdminTransformer::class);
    }
}
