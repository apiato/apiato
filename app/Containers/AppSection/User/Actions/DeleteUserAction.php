<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Parents\Actions\Action;

class DeleteUserAction extends Action
{
    public function run(DeleteUserRequest $request): void
    {
        $user = $request->id
            ? app(FindUserByIdTask::class)->run($request->id)
            : app(GetAuthenticatedUserTask::class)->run();

        app(DeleteUserTask::class)->run($user);
    }
}
