<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class RemoveUserRolesController extends ApiController
{
    public function __invoke(RemoveUserRolesRequest $request, RemoveUserRolesAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserAdminTransformer::class);
    }
}
