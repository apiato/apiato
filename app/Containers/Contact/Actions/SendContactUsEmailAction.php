<?php

namespace App\Containers\Contact\Actions;

use App\Containers\Contact\Tasks\SendContactUsEmailTask;
use App\Containers\Contact\Tasks\ValidateConfirmationCodeTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SendContactUsEmailAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendContactUsEmailAction extends Action
{

    /**
     * @var  \App\Containers\Contact\Tasks\SendContactUsEmailTask
     */
    private $sendContactUsEmailTask;

    /**
     * SendContactUsEmailAction constructor.
     *
     * @param \App\Containers\Contact\Tasks\SendContactUsEmailTask $sendContactUsEmailTask
     */
    public function __construct(SendContactUsEmailTask $sendContactUsEmailTask)
    {
        $this->sendContactUsEmailTask = $sendContactUsEmailTask;
    }

    /**
     * @param $fromEmail
     * @param $message
     * @param $subject
     * @param $fromName
     *
     * @return  bool
     */
    public function run($fromEmail, $message, $subject, $fromName)
    {
        // TODO: keep track of all messages in the system. Create a table in the DB to store messages while sending them

        $result = $this->sendContactUsEmailTask->run($fromEmail, $message, $subject, $fromName);

        return $result;
    }
}
