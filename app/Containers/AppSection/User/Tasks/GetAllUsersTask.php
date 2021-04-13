<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Criterias\AdminsCriteria;
use App\Containers\AppSection\User\Data\Criterias\ClientsCriteria;
use App\Containers\AppSection\User\Data\Criterias\RoleCriteria;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\OrderByCreationDateDescendingCriteria;
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

    public function clients(): self
    {
        $this->repository->pushCriteria(new ClientsCriteria());
        return $this;
    }

    public function admins(): self
    {
        $this->repository->pushCriteria(new AdminsCriteria());
        return $this;
    }

    public function ordered(): self
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this;
    }

    public function withRole($roles): self
    {
        $this->repository->pushCriteria(new RoleCriteria($roles));
        return $this;
    }
}
