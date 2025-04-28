<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CreateUserTask extends ParentTask
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): User
    {
        try {
            $user = $this->repository->create($data);
        } catch (\Throwable) {
            throw new CreateResourceFailedException();
        }

        return $user;
    }
}
