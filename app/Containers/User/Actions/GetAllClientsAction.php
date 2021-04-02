<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllClientsAction extends Action
{
    public function run()
    {
        return Apiato::call('User@GetAllUsersTask',
            [],
            [
                'addRequestCriteria',
                'clients',
                'ordered',
            ]
        );
    }
}
