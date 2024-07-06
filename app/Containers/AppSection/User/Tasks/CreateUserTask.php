<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Data\Resources\RegisterUserDto;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateUserTask extends ParentTask
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(RegisterUserDto $data): User
    {
        try {
            $user = $this->repository->create($data->toArray());
        } catch (\Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }

        return $user;
    }
}
