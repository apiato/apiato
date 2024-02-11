<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindUserByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    public function run(UserResource $data): User
    {
        return $this->findUserByIdTask->run($data->id);
    }
}
