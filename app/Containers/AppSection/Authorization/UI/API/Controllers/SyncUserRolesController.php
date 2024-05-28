<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class SyncUserRolesController extends ApiController
{
    public function __invoke(SyncUserRolesRequest $request, SyncUserRolesAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserAdminTransformer::class)->toArray();
    }
}
