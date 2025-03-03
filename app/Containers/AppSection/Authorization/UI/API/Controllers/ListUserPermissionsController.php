<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ListUserPermissionsController extends ApiController
{
    public function __invoke(ListUserPermissionsRequest $request, ListUserPermissionsAction $action): JsonResponse
    {
        $permissions = $action->run($request->user_id);

        return Response::create($permissions, PermissionAdminTransformer::class)->ok();
    }
}
