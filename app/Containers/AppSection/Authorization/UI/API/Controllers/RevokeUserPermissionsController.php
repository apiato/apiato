<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RevokeUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserPermissionsRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class RevokeUserPermissionsController extends ApiController
{
    public function __invoke(RevokeUserPermissionsRequest $request, RevokeUserPermissionsAction $action): JsonResponse
    {
        $user = $action->run($request);

        return Fractal::create($user, UserAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
