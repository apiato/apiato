<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Ship\Parents\Actions\Action;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsAction extends Action
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllPermissionsRequest $request)
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}
