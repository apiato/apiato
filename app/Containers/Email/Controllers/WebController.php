<?php

namespace App\Containers\Email\Controllers;

use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\Email\Tasks\ValidateConfirmationCodeTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Kernel\Controller\Abstracts\KernelWebController;

/**
 * Class WebController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebController extends KernelWebController
{

    /**
     * @param \App\Containers\Email\Requests\ConfirmUserEmailRequest   $confirmUserEmailRequest
     * @param \App\Containers\User\Tasks\FindUserByIdTask              $findUserByIdTask
     * @param \App\Containers\Email\Tasks\ValidateConfirmationCodeTask $validateConfirmationCodeTask
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmUserEmail(
        ConfirmUserEmailRequest $confirmUserEmailRequest,
        FindUserByIdTask $findUserByIdTask,
        ValidateConfirmationCodeTask $validateConfirmationCodeTask
    ) {

        // find user by ID
        $user = $findUserByIdTask->run($confirmUserEmailRequest->id);

        // validate the confirmation code and update user status is code is valid
        $validateConfirmationCodeTask->run($user, $confirmUserEmailRequest->code);

        // redirect to the app URL
        return redirect(env('APP_FULL_URL'));
    }

}
