<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteUserAction extends ParentAction
{
    public function __construct(
        private readonly DeleteUserTask $deleteUserTask
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteUserRequest $request): void
    {
        $this->deleteUserTask->run($request->id);
    }
}
