<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ListUserPermissionsController extends ApiController
{
    public function __invoke(ListUserPermissionsRequest $request, ListUserPermissionsAction $action): JsonResponse
    {
        $permissions = $action->run($request);

        return Response::createFrom($permissions)->transformWith(PermissionAdminTransformer::class)->ok();
    }
}
