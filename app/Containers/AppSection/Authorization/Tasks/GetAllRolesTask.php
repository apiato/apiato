<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Criterias\ThisLikeThatCriteria;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesTask extends ParentTask
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    /**
     * @param bool $skipPagination
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(bool $skipPagination = false): mixed
    {
        $repository = $this->addRequestCriteria()->repository;

        return $skipPagination ? $repository->all() : $repository->paginate();
    }

    /**
     * @throws RepositoryException
     */
    public function whereGuard(string $guardName): static
    {
        $this->repository->pushCriteria(new ThisLikeThatCriteria('guard_name', $guardName));

        return $this;
    }
}
