<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GivePermissionsToUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(GivePermissionsToUserRequest $request): User
    {
        return $this->findUserByIdTask->run($request->id)
            ->givePermissionTo($request->permission_ids);
    }
}
