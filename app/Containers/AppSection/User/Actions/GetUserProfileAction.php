<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Authenticatable;

class GetUserProfileAction extends ParentAction
{
    public function __construct(
        private readonly GetAuthenticatedUserTask $getAuthenticatedUserTask,
    ) {
    }

    public function run(): Authenticatable|User
    {
        return $this->getAuthenticatedUserTask->run();
    }
}
