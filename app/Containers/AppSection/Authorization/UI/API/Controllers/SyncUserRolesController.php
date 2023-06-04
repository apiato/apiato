<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class SyncUserRolesController extends ApiController
{
    public function __construct(
        private readonly SyncUserRolesAction $syncUserRolesAction
    ) {
    }

    public function __invoke(SyncUserRolesRequest $request): array
    {
        $user = $this->syncUserRolesAction->run($request);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }
}
