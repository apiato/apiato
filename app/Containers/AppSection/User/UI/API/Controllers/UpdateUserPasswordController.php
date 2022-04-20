<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\User\Actions\UpdateUserPasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserPasswordRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateUserPasswordController extends ApiController
{
    /**
     * @param UpdateUserPasswordRequest $request
     * @return array
     * @throws IncorrectIdException
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function updateUserPassword(UpdateUserPasswordRequest $request): array
    {
        $user = app(UpdateUserPasswordAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
