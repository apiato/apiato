<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class RevokeRolePermissionsController extends ApiController
{
    public function __invoke(RevokeRolePermissionsRequest $request, RevokeRolePermissionsAction $action): JsonResponse
    {
        $role = $action->run($request);

        return Fractal::create($role, RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
