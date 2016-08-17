<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\FindUserTask;
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
     * @var  \App\Containers\User\Tasks\FindUserTask
     */
    private $findUserTask;

    /**
     * FindUserByAnythingAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserTask $findUserTask
     */
    public function __construct(
        FindUserTask $findUserTask
    ) {
        $this->findUserTask = $findUserTask;
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
            $user = $this->findUserTask->byId($userId);
        } else {
            if ($token) {
                $user = Auth::user();
            } else {
                if ($visitorId) {
                    $user = $this->findUserTask->byVisitorId($visitorId);
                }
            }
        }

        return $user;
    }

}
