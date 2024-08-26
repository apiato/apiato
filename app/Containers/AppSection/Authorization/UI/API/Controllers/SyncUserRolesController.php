<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class SyncUserRolesController extends ApiController
{
    public function __invoke(SyncUserRolesRequest $request, SyncUserRolesAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserAdminTransformer::class);
    }
}
