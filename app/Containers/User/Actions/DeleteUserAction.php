<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  void
     */
    public function run(Request $request): void
    {
        $userId = $request->id;

        $user = $userId ?
            Apiato::call('User@FindUserByIdTask', [$userId]) : Apiato::call('Authentication@GetAuthenticatedUserTask');

        Apiato::call('User@DeleteUserTask', [$user]);
    }
}
