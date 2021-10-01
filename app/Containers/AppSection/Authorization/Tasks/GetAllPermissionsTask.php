<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsTask extends Task
{
    public function __construct(
        protected PermissionRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(bool $skipPagination = false): mixed
    {
        $repository = $this->addRequestCriteria()->repository;

        return $skipPagination ? $repository->all() : $repository->paginate();
    }
}
