<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Ship\Parents\Actions\Action;

class GetAllRolesAction extends Action
{
    public function run()
    {
        return app(GetAllRolesTask::class)->run();
    }
}
