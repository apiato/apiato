<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllUsersAction extends Action
{
    public function run()
    {
        return Apiato::call(GetAllUsersTask::class,
            [],
            [
                'addRequestCriteria',
                'ordered'
            ]
        );
    }
}
