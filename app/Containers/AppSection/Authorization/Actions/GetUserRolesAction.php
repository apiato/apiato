<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetUserRolesAction extends ParentAction
{
    /**
     * @param GetUserRolesRequest $request
     * @return mixed
     * @throws NotFoundException
     */
    public function run(GetUserRolesRequest $request): mixed
    {
        $user = app(FindUserByIdTask::class)->run($request->id);

        return $user->roles;
    }
}
