<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserPermissionsRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RevokeUserPermissionsController extends ApiController
{
    public function __invoke(RevokeUserPermissionsRequest $request, RevokeUserPermissionsAction $action): JsonResponse
    {
        $user = $action->run($request);

        return Response::createFrom($user)
            ->transformWith(UserAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
