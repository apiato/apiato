<?php

namespace App\Containers\Email\Tasks;

use App\Containers\Email\Subtasks\GenerateEmailConfirmationUrlSubtask;
use App\Containers\Email\Subtasks\SendConfirmationEmailSubtask;
use App\Containers\Email\Subtasks\SetUserEmailSubtask;
use App\Kernel\Task\Abstracts\Task;

/**
 * Class SetUserEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailTask extends Task
{

    /**
     * @var  \App\Containers\Email\Subtasks\SetUserEmailSubtask
     */
    private $setUserEmailSubtask;

    /**
     * @var  \App\Containers\Email\Subtasks\GenerateEmailConfirmationUrlSubtask
     */
    private $generateEmailConfirmationUrlSubtask;

    /**
     * @var  \App\Containers\Email\Subtasks\SendConfirmationEmailSubtask
     */
    private $sendConfirmationEmailSubtask;

    /**
     * SetUserEmailTask constructor.
     *
     * @param \App\Containers\Email\Subtasks\SetUserEmailSubtask                 $setUserEmailSubtask
     * @param \App\Containers\Email\Subtasks\GenerateEmailConfirmationUrlSubtask $generateEmailConfirmationUrlSubtask
     * @param \App\Containers\Email\Subtasks\SendConfirmationEmailSubtask        $sendConfirmationEmailSubtask
     */
    public function __construct(
        SetUserEmailSubtask $setUserEmailSubtask,
        GenerateEmailConfirmationUrlSubtask $generateEmailConfirmationUrlSubtask,
        SendConfirmationEmailSubtask $sendConfirmationEmailSubtask
    ) {
        $this->setUserEmailSubtask = $setUserEmailSubtask;
        $this->generateEmailConfirmationUrlSubtask = $generateEmailConfirmationUrlSubtask;
        $this->sendConfirmationEmailSubtask = $sendConfirmationEmailSubtask;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($userId, $email)
    {
        // set the email on the user in the database
        $user = $this->setUserEmailSubtask->run($userId, $email);

        // generate confirmation code, store it on the memory and inject it in url
        $confirmationUrl = $this->generateEmailConfirmationUrlSubtask->run($user);

        // send a confirmation email to the user with the link
        $this->sendConfirmationEmailSubtask->run($user, $confirmationUrl);

        return true;
    }
}
