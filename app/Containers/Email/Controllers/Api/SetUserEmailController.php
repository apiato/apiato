<?php

namespace App\Containers\Email\Controllers\Api;

use App\Containers\Email\Requests\SetEmailRequest;
use App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask;
use App\Containers\Email\Tasks\SendConfirmationEmailTask;
use App\Containers\Email\Tasks\SetUserEmailTask;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class SetUserEmailController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailController extends ApiController
{

    /**
     * @param \App\Containers\Email\Requests\SetEmailRequest               $setEmailRequest
     * @param \App\Containers\Email\Tasks\SetUserEmailTask                 $setUserEmailTask
     * @param \App\Containers\Email\Tasks\GenerateEmailConfirmationUrlTask $generateEmailConfirmationUrlTask
     * @param \App\Containers\Email\Tasks\SendConfirmationEmailTask        $sendConfirmationEmailTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function handle(
        SetEmailRequest $setEmailRequest,
        SetUserEmailTask $setUserEmailTask,
        GenerateEmailConfirmationUrlTask $generateEmailConfirmationUrlTask,
        SendConfirmationEmailTask $sendConfirmationEmailTask
    ) {
        // set the email on the user in the database
        $user = $setUserEmailTask->run($setEmailRequest->id, $setEmailRequest->email);

        // generate confirmation code, store it on the memory and inject it in url
        $confirmationUrl = $generateEmailConfirmationUrlTask->run($user);

        // send a confirmation email to the user with the link
        $sendConfirmationEmailTask->run($user, $confirmationUrl);

        return $this->response->accepted(null, [
            'message' => 'User Email Set Successfully, Waiting User Email Confirmation.',
        ]);
    }
}
