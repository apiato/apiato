<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindRoleByIdController extends ApiController
{
    public function __invoke(FindRoleByIdRequest $request, FindRoleByIdAction $action): array
    {
        $role = $action->run($request);

        return $this->transform($role, RoleAdminTransformer::class);
    }
}
