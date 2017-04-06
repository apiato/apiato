<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserAction extends Action
{

    /**
     * @param      $userId
     * @param null $token
     *
     * @return  mixed
     */
    public function run($userId, $token = null)
    {
        if ($userId) {
            $user = $this->call(FindUserByIdTask::class, [$userId]);
        } else {
            if ($token) {
                $user = $this->call(GetAuthenticatedUserTask::class);
            }
        }

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
