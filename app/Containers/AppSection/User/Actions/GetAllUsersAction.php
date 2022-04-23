<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return app(GetAllUsersTask::class)->run();
    }
}
