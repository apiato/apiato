<?php

namespace App\Containers\User\Actions;

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
     * @return  mixed
     */
    public function run(Request $request)
    {
        if ($userId = $request->id) {
            $user = $this->call('User@FindUserByIdTask', [$userId]);
        } else {
            $user = $this->call('Authentication@GetAuthenticatedUserTask');
        }

        $this->call('User@DeleteUserTask', [$user]);

        return $user;
    }
}
