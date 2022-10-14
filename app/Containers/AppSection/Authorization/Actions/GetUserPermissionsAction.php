<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserPermissionsRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetUserPermissionsAction extends ParentAction
{
    /**
     * @param GetUserPermissionsRequest $request
     * @return mixed
     */
    public function run(GetUserPermissionsRequest $request): mixed
    {
        $user = app(FindUserByIdTask::class)->run($request->id);
        return $user->permissions;
    }
}
