<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RevokeRolePermissionsController extends ApiController
{
    public function __invoke(RevokeRolePermissionsRequest $request, RevokeRolePermissionsAction $action): JsonResponse
    {
        $role = $action->run($request);

        return Response::createFrom($role)
            ->transformWith(RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
