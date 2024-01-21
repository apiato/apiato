<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class AttachPermissionsToUserController extends ApiController
{
    public function __invoke(AttachPermissionsToUserRequest $request, AttachPermissionsToUserAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserAdminTransformer::class, ['permissions']);
    }
}
