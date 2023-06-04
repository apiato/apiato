<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromUserController extends ApiController
{
    public function __construct(
        private readonly DetachPermissionsFromUserAction $detachPermissionsFromUserAction
    ) {
    }

    public function __invoke(DetachPermissionsFromUserRequest $request): array
    {
        $user = $this->detachPermissionsFromUserAction->run($request);

        return $this->transform($user, UserTransformer::class, ['permissions']);
    }
}
