<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllAdminsAction extends Action
{
    public function run()
    {
        return Apiato::call(GetAllUsersTask::class,
            [],
            [
                'addRequestCriteria',
                'admins',
                'ordered',
            ]
        );
    }
}
