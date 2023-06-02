<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\DeleteRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteRoleAction extends ParentAction
{
    public function __construct(
        private readonly DeleteRoleTask $deleteRoleTask
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteRoleRequest $request): void
    {
        $this->deleteRoleTask->run($request->id);
    }
}
