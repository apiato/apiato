<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetUserRolesController extends ApiController
{
    public function getUserRoles(GetUserRolesRequest $request)
    {
        $roles = app(GetUserRolesAction::class)->run($request);
        return $this->transform($roles, RoleTransformer::class);
    }

}
