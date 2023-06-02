<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeRolesFromUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolesFromUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class RevokeRolesFromUserController extends ApiController
{
    public function __construct(
        private readonly RevokeRolesFromUserAction $revokeRolesFromUserAction
    ) {
    }

    public function __invoke(RevokeRolesFromUserRequest $request): array
    {
        $user = $this->revokeRolesFromUserAction->run($request);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }
}
