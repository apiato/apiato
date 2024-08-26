<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GivePermissionsToUserController extends ApiController
{
    public function __invoke(GivePermissionsToUserRequest $request, GivePermissionsToUserAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserAdminTransformer::class, ['permissions']);
    }
}
