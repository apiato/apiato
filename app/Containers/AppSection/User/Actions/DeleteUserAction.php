<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteUserAction extends ParentAction
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws DeleteResourceFailedException
     */
    public function run(DeleteUserRequest $request): bool
    {
        return $this->repository->delete($request->id);
    }
}
