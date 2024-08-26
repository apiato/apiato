<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class RemoveUserRolesController extends ApiController
{
    public function __invoke(RemoveUserRolesRequest $request, RemoveUserRolesAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserAdminTransformer::class)
            ->parseIncludes(['roles'])
            ->toArray();
    }
}
