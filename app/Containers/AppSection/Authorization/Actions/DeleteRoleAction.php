<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\DeleteRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Actions\Action;

class DeleteRoleAction extends Action
{
    /**
     * @throws DeleteResourceFailedException
     */
    public function run(DeleteRoleRequest $request): void
    {
        app(DeleteRoleTask::class)->run($request->id);
    }
}
