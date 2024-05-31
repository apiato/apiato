<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserPermissionsRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class RevokeUserPermissionsController extends ApiController
{
    public function __invoke(RevokeUserPermissionsRequest $request, RevokeUserPermissionsAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->toArray();
    }
}
