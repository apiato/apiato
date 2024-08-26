<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class ListUserPermissionsController extends ApiController
{
    public function __invoke(ListUserPermissionsRequest $request, ListUserPermissionsAction $action): JsonResponse
    {
        $permissions = $action->run($request);

        return Fractal::create($permissions, PermissionAdminTransformer::class)->ok();
    }
}
