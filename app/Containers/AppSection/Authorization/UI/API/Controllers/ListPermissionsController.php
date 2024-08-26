<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class ListPermissionsController extends ApiController
{
    public function __invoke(ListPermissionsRequest $request, ListPermissionsAction $action): JsonResponse
    {
        $permissions = $action->run();

        return Fractal::create($permissions, PermissionAdminTransformer::class)->ok();
    }
}
