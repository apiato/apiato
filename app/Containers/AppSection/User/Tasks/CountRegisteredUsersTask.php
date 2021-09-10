<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\NotNullCriteria;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class CountRegisteredUsersTask extends Task
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @throws RepositoryException
     */
    public function run(): int
    {
        $this->repository->pushCriteria(new NotNullCriteria('email'));
        return $this->repository->all()->count();
    }
}
