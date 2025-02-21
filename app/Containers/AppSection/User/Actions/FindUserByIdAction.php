<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

final class FindUserByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(FindUserByIdRequest $request): User
    {
        return $this->findUserByIdTask->run($request->user_id);
    }
}
