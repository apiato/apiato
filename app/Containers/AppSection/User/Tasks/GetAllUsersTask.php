<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Criterias\AdminsCriteria;
use App\Containers\AppSection\User\Data\Criterias\ClientsCriteria;
use App\Containers\AppSection\User\Data\Criterias\RoleCriteria;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

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

    /**
     * @throws RepositoryException
     */
    public function clients(): static
    {
        $this->repository->pushCriteria(new ClientsCriteria());
        return $this;
    }

    /**
     * @throws RepositoryException
     */
    public function admins(): static
    {
        $this->repository->pushCriteria(new AdminsCriteria());
        return $this;
    }

    /**
     * @throws RepositoryException
     */
    public function ordered(): static
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this;
    }

    /**
     * @throws RepositoryException
     */
    public function withRole($roles): static
    {
        $this->repository->pushCriteria(new RoleCriteria($roles));
        return $this;
    }
}
