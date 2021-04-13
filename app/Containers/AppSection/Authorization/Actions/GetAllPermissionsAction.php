<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action;

class GetAllPermissionsAction extends Action
{
    public function run()
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}
