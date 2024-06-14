<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class FindPermissionByIdController extends ApiController
{
    public function __invoke(FindPermissionByIdRequest $request, FindPermissionByIdAction $action): JsonResponse
    {
        $permission = $action->run($request);

        return Response::createFrom($permission)->transformWith(PermissionAdminTransformer::class)->ok();
    }
}
