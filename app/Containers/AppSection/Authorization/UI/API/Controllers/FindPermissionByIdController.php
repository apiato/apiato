<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class FindPermissionByIdController extends ApiController
{
    public function __invoke(FindPermissionByIdRequest $request, FindPermissionByIdAction $action): JsonResponse
    {
        $permission = $action->run($request->permission_id);

        return Response::create($permission, PermissionAdminTransformer::class)->ok();
    }
}
