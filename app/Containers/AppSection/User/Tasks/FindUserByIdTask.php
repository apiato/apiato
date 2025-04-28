<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindUserByIdTask extends ParentTask
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function run(mixed $userId): User
    {
        return $this->repository->getById($userId);
    }
}
