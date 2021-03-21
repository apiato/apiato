<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\NotNullCriteria;
use App\Ship\Parents\Tasks\Task;

class CountRegisteredUsersTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(): int
    {
        $this->repository->pushCriteria(new NotNullCriteria('email'));
        return $this->repository->all()->count();
    }
}
