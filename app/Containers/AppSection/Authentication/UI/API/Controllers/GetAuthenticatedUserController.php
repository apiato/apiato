<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAuthenticatedUserController extends ApiController
{
    /**
     * @param GetAuthenticatedUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
