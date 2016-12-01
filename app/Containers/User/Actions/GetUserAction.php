<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class GetUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\User\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * FindUserByAnythingAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask  $findUserByVisitorIdTask
     * @param \App\Containers\User\Tasks\FindUserByIdTask         $findUserByIdTask
     * @param \App\Containers\User\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        FindUserByIdTask $findUserByIdTask,
        GetAuthenticatedUserTask $getAuthenticatedUserTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->findUserByIdTask = $findUserByIdTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param $userId
     * @param $visitorId
     * @param $token
     *
     * @return  mixed
     */
    public function run($userId, $visitorId = null, $token = null)
    {
        if ($userId) {
            $user = $this->findUserByIdTask->run($userId)->withToken();
        } else {
            if ($token) {
                $user = $this->getAuthenticatedUserTask->run()->withToken();
            } else {
                if ($visitorId) {
                    $user = $this->findUserByVisitorIdTask->run($visitorId);
                }
            }
        }

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
