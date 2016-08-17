<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask;
use App\Containers\Email\Tasks\SendConfirmationEmailTask;
use App\Containers\Email\Tasks\SetUserEmailTask;
use App\Containers\User\Tasks\FindUserTask;
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
     * @var  \App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask
     */
    private $generateEmailConfirmationUrlTask;

    /**
     * @var  \App\Containers\Email\Tasks\SendConfirmationEmailTask
     */
    private $sendConfirmationEmailTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserTask
     */
    private $findUserTask;

    /**
     * SetUserEmailAction constructor.
     *
     * @param \App\Containers\Email\Tasks\SetUserEmailTask                 $setUserEmailTask
     * @param \App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask $generateEmailConfirmationUrlTask
     * @param \App\Containers\Email\Tasks\SendConfirmationEmailTask        $sendConfirmationEmailTask
     * @param \App\Containers\User\Tasks\FindUserTask                      $findUserTask
     */
    public function __construct(
        SetUserEmailTask $setUserEmailTask,
        GenerateEmailConfirmationUrlTask $generateEmailConfirmationUrlTask,
        SendConfirmationEmailTask $sendConfirmationEmailTask,
        FindUserTask $findUserTask
    ) {
        $this->setUserEmailTask = $setUserEmailTask;
        $this->generateEmailConfirmationUrlTask = $generateEmailConfirmationUrlTask;
        $this->sendConfirmationEmailTask = $sendConfirmationEmailTask;
        $this->findUserTask = $findUserTask;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($visitorId, $email)
    {
        $user = $this->findUserTask->byVisitorId($visitorId);

        $this->setUserEmailTask->run($user->id, $email);

        return true;
    }
}
