<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ListPermissionsController extends ApiController
{
    public function __invoke(ListPermissionsRequest $request, ListPermissionsAction $action): JsonResponse
    {
        $permissions = $action->run();

        return Response::create($permissions, PermissionAdminTransformer::class)->ok();
    }
}
