<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Ship\Parents\Actions\Action;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesAction extends Action
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllRolesRequest $request)
    {
        return app(GetAllRolesTask::class)->run();
    }
}
