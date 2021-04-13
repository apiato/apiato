<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllAdminsAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->admins()->ordered()->run();
    }
}
