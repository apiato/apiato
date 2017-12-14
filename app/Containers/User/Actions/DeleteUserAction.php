<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     */
    public function run(Transporter $data): void
    {
        $user = $data->id ?
            Apiato::call('User@FindUserByIdTask',
                [$data->id]) : Apiato::call('Authentication@GetAuthenticatedUserTask');

        Apiato::call('User@DeleteUserTask', [$user]);
    }
}
