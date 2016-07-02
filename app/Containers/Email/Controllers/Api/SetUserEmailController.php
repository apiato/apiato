<?php

namespace App\Containers\Email\Controllers\Api;

use App\Containers\Email\Requests\SetEmailRequest;
use App\Containers\Email\Subtasks\GenerateEmailConfirmationUrlSubtask;
use App\Containers\Email\Subtasks\SendConfirmationEmailSubtask;
use App\Containers\Email\Subtasks\SetUserEmailSubtask;
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
     * @param \App\Containers\Email\Subtasks\SetUserEmailSubtask                 $setUserEmailSubtask
     * @param \App\Containers\Email\Subtasks\GenerateEmailConfirmationUrlSubtask $generateEmailConfirmationUrlSubtask
     * @param \App\Containers\Email\Subtasks\SendConfirmationEmailSubtask        $sendConfirmationEmailSubtask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function handle(
        SetEmailRequest $setEmailRequest,
        SetUserEmailSubtask $setUserEmailSubtask,
        GenerateEmailConfirmationUrlSubtask $generateEmailConfirmationUrlSubtask,
        SendConfirmationEmailSubtask $sendConfirmationEmailSubtask
    ) {
        // set the email on the user in the database
        $user = $setUserEmailSubtask->run($setEmailRequest->id, $setEmailRequest->email);

        // generate confirmation code, store it on the memory and inject it in url
        $confirmationUrl = $generateEmailConfirmationUrlSubtask->run($user);

        // send a confirmation email to the user with the link
        $sendConfirmationEmailSubtask->run($user, $confirmationUrl);

        return $this->response->accepted(null, [
            'message' => 'User Email Sent Successfully, Waiting User Email Confirmation.',
        ]);
    }
}
