<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param null $userId
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId = null): User
    {
        $user = $userId ?
            Apiato::call('User@FindUserByIdTask', [$userId]) : Apiato::call('Authentication@GetAuthenticatedUserTask');

        Apiato::call('User@DeleteUserTask', [$user]);

        return $user;
    }
}
