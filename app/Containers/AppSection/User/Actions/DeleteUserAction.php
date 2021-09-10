<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Actions\Action;

class DeleteUserAction extends Action
{
    /**
     * @throws DeleteResourceFailedException
     */
    public function run(DeleteUserRequest $request): void
    {
        app(DeleteUserTask::class)->run($request->id);
    }
}
