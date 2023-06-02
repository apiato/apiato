<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetUserRolesAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(GetUserRolesRequest $request): mixed
    {
        $user = $this->findUserByIdTask->run($request->id);

        return $user->roles;
    }
}
