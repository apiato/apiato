<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllClientsAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->clients()->ordered()->run();
    }
}
