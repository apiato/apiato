<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ListRolePermissionsController extends ApiController
{
    public function __invoke(ListRolePermissionsRequest $request, ListRolePermissionsAction $action): JsonResponse
    {
        $permissions = $action->run($request);

        return Response::createFrom($permissions)->transformWith(PermissionAdminTransformer::class)->ok();
    }
}
