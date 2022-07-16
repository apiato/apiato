<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AssignPermissionsToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignPermissionsToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class AssignPermissionsToUserController extends ApiController
{
    /**
     * @param AssignPermissionsToUserRequest $request
     * @return \App\Containers\AppSection\User\Models\User
     */
    public function assignPermissionsToUser(AssignPermissionsToUserRequest $request)
    {
        $user = app(AssignPermissionsToUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class, ['permissions']);
    }

}
