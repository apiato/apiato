<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\DeleteUserTask;
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

        $isDeleted = $this->call(DeleteUserTask::class, [$userId]);

        return $isDeleted;
    }
}
