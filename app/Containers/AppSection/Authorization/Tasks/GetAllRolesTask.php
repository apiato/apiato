<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesTask extends Task
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run()
    {
        return $this->addRequestCriteria()->repository->paginate();
    }
}
