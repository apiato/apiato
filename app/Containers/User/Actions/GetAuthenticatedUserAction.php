<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAuthenticatedUserAction.
 */
class GetAuthenticatedUserAction extends Action
{

    /**
     * @return mixed
     * @throws \App\Containers\User\Exceptions\UserNotFoundException
     */
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
