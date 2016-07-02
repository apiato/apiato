<?php

namespace App\Containers\Email\Controllers\Web;

use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\Email\Subtasks\ValidateConfirmationCodeSubtask;
use App\Containers\User\Subtasks\FindUserByIdSubtask;
use App\Kernel\Controller\Abstracts\WebController;

/**
 * Class ConfirmUserEmailController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmUserEmailController extends WebController
{

    /**
     * @param \App\Containers\Email\Requests\ConfirmUserEmailRequest $confirmUserEmailRequest
     * @param \App\Containers\User\Subtasks\FindUserByIdSubtask            $findUserByIdSubtask
     *
     * @return  bool
     * @throws \App\Containers\User\Subtasks\UserNotFoundException
     */
    public function handle(
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
