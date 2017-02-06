<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class GetUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * @var  \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * GetUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByIdTask                   $findUserByIdTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(
        FindUserByIdTask $findUserByIdTask,
        GetAuthenticatedUserTask $getAuthenticatedUserTask
    ) {
        $this->findUserByIdTask = $findUserByIdTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param      $userId
     * @param null $token
     *
     * @return  mixed
     */
    public function run($userId, $token = null)
    {
        if ($userId) {
            $user = $this->findUserByIdTask->run($userId)->withToken();
        } else {
            if ($token) {
                $user = $this->getAuthenticatedUserTask->run()->withToken();
            }
        }

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
