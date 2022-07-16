<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromUserController extends ApiController
{
    /**
     * @param DetachPermissionsFromUserRequest $request
     * @return \App\Containers\AppSection\User\Models\User
     */
    public function detachPermissionFromUser(DetachPermissionsFromUserRequest $request)
    {
        $user = app(DetachPermissionsFromUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class, ['permissions']);
    }
}
