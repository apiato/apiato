<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}
