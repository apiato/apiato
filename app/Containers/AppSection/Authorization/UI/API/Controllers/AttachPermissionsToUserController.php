<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class AttachPermissionsToUserController extends ApiController
{
    public function __construct(
        private readonly AttachPermissionsToUserAction $attachPermissionsToUserAction
    ) {
    }

    public function __invoke(AttachPermissionsToUserRequest $request): array
    {
        $user = $this->attachPermissionsToUserAction->run($request);

        return $this->transform($user, UserTransformer::class, ['permissions']);
    }
}
