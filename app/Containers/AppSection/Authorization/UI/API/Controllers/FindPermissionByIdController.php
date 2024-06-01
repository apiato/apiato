<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class FindPermissionByIdController extends ApiController
{
    public function __invoke(FindPermissionByIdRequest $request, FindPermissionByIdAction $action): JsonResponse
    {
        $permission = $action->run($request);

        return Fractal::create($permission, PermissionAdminTransformer::class)->ok();
    }
}
