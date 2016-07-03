<?php

namespace App\Containers\Email\Controllers;

use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\Email\Subtasks\ValidateConfirmationCodeSubtask;
use App\Containers\User\Subtasks\FindUserByIdSubtask;
use App\Kernel\Controller\Abstracts\KernelWebController;

/**
 * Class WebController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebController extends KernelWebController
{

    /**
     * @param \App\Containers\Email\Requests\ConfirmUserEmailRequest         $confirmUserEmailRequest
     * @param \App\Containers\User\Subtasks\FindUserByIdSubtask              $findUserByIdSubtask
     * @param \App\Containers\Email\Subtasks\ValidateConfirmationCodeSubtask $validateConfirmationCodeSubtask
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmUserEmail(
        ConfirmUserEmailRequest $confirmUserEmailRequest,
        FindUserByIdSubtask $findUserByIdSubtask,
        ValidateConfirmationCodeSubtask $validateConfirmationCodeSubtask
    ) {

        // find user by ID
        $user = $findUserByIdSubtask->run($confirmUserEmailRequest->id);

        // validate the confirmation code and update user status is code is valid
        $validateConfirmationCodeSubtask->run($user, $confirmUserEmailRequest->code);

        // redirect to the app URL
        return redirect(env('APP_FULL_URL'));
    }

}
