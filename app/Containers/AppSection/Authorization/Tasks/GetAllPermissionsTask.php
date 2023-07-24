<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Criterias\ThisLikeThatCriteria;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsTask extends ParentTask
{
    public function __construct(
        protected readonly PermissionRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(bool $skipPagination = false): mixed
    {
        $this->addRequestCriteria($this->repository);

        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }

    /**
     * @throws RepositoryException
     */
    public function whereGuard(string|null $guardName): static
    {
        if ($guardName) {
            $this->repository->pushCriteria(new ThisLikeThatCriteria('guard_name', $guardName));
        }

        return $this;
    }
}
