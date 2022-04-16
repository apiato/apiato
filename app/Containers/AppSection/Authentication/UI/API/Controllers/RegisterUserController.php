<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class RegisterUserController extends ApiController
{
    /**
     * @param RegisterUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     */
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = app(RegisterUserAction::class)->transactionalRun($request);

        return $this->transform($user, UserTransformer::class);
    }
}
