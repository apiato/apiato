<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DeleteUserAction extends Action
{
    public function run(DataTransporter $data): void
    {
        $user = $data->id ?
            Apiato::call('User@FindUserByIdTask',
                [$data->id]) : Apiato::call('Authentication@GetAuthenticatedUserTask');

        Apiato::call('User@DeleteUserTask', [$user]);
    }
}
