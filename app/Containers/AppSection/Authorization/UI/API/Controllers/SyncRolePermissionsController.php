<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class SyncRolePermissionsController extends ApiController
{
    public function __invoke(SyncRolePermissionsRequest $request, SyncRolePermissionsAction $action): JsonResponse
    {
        $role = $action->run($request);

        return Response::createFrom($role)
            ->transformWith(RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
