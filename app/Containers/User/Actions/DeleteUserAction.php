<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param $userId
     *
     * @return  bool
     */
    public function run($userId = null)
    {
        $userId = $userId ? : $this->call(GetAuthenticatedUserTask::class)->id;

        $user = $this->call(FindUserByIdTask::class, [$userId]);

        $this->call(DeleteUserTask::class, [$user]);

        return $user;
    }
}
