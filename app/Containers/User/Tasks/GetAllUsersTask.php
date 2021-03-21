<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\AdminsCriteria;
use App\Containers\User\Data\Criterias\ClientsCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllUsersTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function clients(): void
    {
        $this->repository->pushCriteria(new ClientsCriteria());
    }

    public function admins(): void
    {
        $this->repository->pushCriteria(new AdminsCriteria());
    }

    public function ordered(): void
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function withRole($roles): void
    {
        $this->repository->pushCriteria(new RoleCriteria($roles));
    }
}
