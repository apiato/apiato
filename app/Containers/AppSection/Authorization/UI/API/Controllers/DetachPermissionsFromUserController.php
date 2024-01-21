<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromUserController extends ApiController
{
    public function __invoke(DetachPermissionsFromUserRequest $request, DetachPermissionsFromUserAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserAdminTransformer::class);
    }
}
