<?php

namespace App\Containers\User\Actions;

<<<<<<< HEAD
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tasks\FindUserByIdTask;
=======
>>>>>>> apiato
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
<<<<<<< HEAD
            $user = $this->call(FindAuthenticatedUserTask::class);
=======
            $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
>>>>>>> apiato
        }

        Apiato::call('User@DeleteUserTask', [$user]);

        return $user;
    }
}
