<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return app(GetAllRolesTask::class)->run();
    }
}
