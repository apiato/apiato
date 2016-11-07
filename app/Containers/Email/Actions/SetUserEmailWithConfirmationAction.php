<?php

namespace App\Containers\Email\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask;
use App\Containers\Email\Tasks\SendConfirmationEmailTask;
use App\Containers\Email\Tasks\SetUserEmailTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SetUserEmailWithConfirmationAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailWithConfirmationAction extends Action
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
     * @var  \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * SetUserEmailAction constructor.
     *
     * @param \App\Containers\Email\Tasks\SetUserEmailTask                  $setUserEmailTask
     * @param \App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask  $generateEmailConfirmationUrlTask
     * @param \App\Containers\Email\Tasks\SendConfirmationEmailTask         $sendConfirmationEmailTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(
        SetUserEmailTask $setUserEmailTask,
        GenerateEmailConfirmationUrlTask $generateEmailConfirmationUrlTask,
        SendConfirmationEmailTask $sendConfirmationEmailTask,
        GetAuthenticatedUserTask $getAuthenticatedUserTask
    ) {
        $this->setUserEmailTask = $setUserEmailTask;
        $this->generateEmailConfirmationUrlTask = $generateEmailConfirmationUrlTask;
        $this->sendConfirmationEmailTask = $sendConfirmationEmailTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($email, $userId = null)
    {
        if(!$userId){
            $userId = $this->getAuthenticatedUserTask->run()->id;
        }

        // set the email on the user in the database
        $user = $this->setUserEmailTask->run($userId, $email);

        // generate confirmation code, store it on the memory and inject it in url
        $confirmationUrl = $this->generateEmailConfirmationUrlTask->run($user);

        // send a confirmation email to the user with the link
        $this->sendConfirmationEmailTask->run($user, $confirmationUrl);

        return true;
    }
}
