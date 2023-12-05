<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\ListRolesTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class ListRolesAction extends ParentAction
{
    public function __construct(
        private readonly ListRolesTask $listRolesTask
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return $this->listRolesTask->whereGuard(activeGuard())->run();
    }
}
