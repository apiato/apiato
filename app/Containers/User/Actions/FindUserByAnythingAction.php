<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\FindUserByIdTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;
use Illuminate\Support\Facades\Auth;

/**
 * Class FindUserByAnythingAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByAnythingAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * FindUserByAnythingAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask $findUserByVisitorIdTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        FindUserByIdTask $findUserByIdTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->findUserByIdTask = $findUserByIdTask;
    }

    /**
     * @param $userId
     * @param $visitorId
     * @param $token
     *
     * @return  mixed
     */
    public function run($userId, $visitorId, $token)
    {
        if ($userId) {
            $user = $this->findUserByIdTask->run($userId);
        } else {
            if ($token) {
                $user = Auth::user();
            } else {
                if ($visitorId) {
                    $user = $this->findUserByVisitorIdTask->run($visitorId);
                }
            }
        }

        return $user;
    }

}
