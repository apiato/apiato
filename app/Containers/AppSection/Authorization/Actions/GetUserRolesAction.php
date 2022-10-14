<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetUserRolesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetUserRolesRequest $request): mixed
    {
        $user = app(FindUserByIdTask::class)->run($request->id);
        return $user->roles;
    }
}
