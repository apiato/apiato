<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Tasks\SetUserEmailTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SetVisitorEmailAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetVisitorEmailAction extends Action
{

    /**
     * @var  \App\Containers\Email\Tasks\SetUserEmailTask
     */
    private $setUserEmailTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * SetVisitorEmailAction constructor.
     *
     * @param \App\Containers\Email\Tasks\SetUserEmailTask       $setUserEmailTask
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask $findUserByVisitorIdTask
     */
    public function __construct(
        SetUserEmailTask $setUserEmailTask,
        FindUserByVisitorIdTask $findUserByVisitorIdTask
    ) {
        $this->setUserEmailTask = $setUserEmailTask;
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($visitorId, $email)
    {
        $user = $this->findUserByVisitorIdTask->run($visitorId);

        $this->setUserEmailTask->run($user->id, $email);

        return true;
    }
}
