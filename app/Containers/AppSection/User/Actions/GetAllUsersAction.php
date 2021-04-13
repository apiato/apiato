<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllUsersAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->ordered()->run();
    }
}
