<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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
     * @return  mixed
     */
    public function run(Request $request)
    {
        if ($userId = $request->id) {
            $user = Apiato::call('User@FindUserByIdTask', [$userId]);
        } else {
            $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
        }

        Apiato::call('User@DeleteUserTask', [$user]);

        return $user;
    }
}
