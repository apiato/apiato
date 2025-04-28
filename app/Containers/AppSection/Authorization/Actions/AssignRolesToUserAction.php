<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class AssignRolesToUserAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(AssignRolesToUserRequest $request): User
    {
        return $this->findUserByIdTask->run($request->user_id)
            ->assignRole($request->role_ids);
    }
}
