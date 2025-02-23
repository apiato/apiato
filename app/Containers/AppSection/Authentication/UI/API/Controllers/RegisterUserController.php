<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

final class RegisterUserController extends ApiController
{
    public function __invoke(RegisterUserRequest $request, RegisterUserAction $action): array
    {
        $user = $action->transactionalRun($request->sanitize([
            'email',
            'password',
            'name',
            'gender',
            'birth',
        ]));

        return $this->transform($user, UserTransformer::class);
    }
}
