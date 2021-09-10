<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Ship\Parents\Actions\Action;

class GetAllRolesAction extends Action
{
    public function run(GetAllRolesRequest $request)
    {
        return app(GetAllRolesTask::class)->addRequestCriteria()->run();
    }
}
