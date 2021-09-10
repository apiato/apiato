<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Ship\Parents\Actions\Action;

class GetAllPermissionsAction extends Action
{
    public function run(GetAllPermissionsRequest $request)
    {
        return app(GetAllPermissionsTask::class)->addRequestCriteria()->run();
    }
}
