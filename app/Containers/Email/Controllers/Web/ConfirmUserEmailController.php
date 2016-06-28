<?php

namespace App\Containers\Email\Controllers\Web;

use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\Email\Tasks\ValidateConfirmationCodeTask;
use App\Containers\User\Tasks\FindUserByIdTask;
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
     * @param \App\Containers\User\Tasks\FindUserByIdTask            $findUserByIdTask
     *
     * @return  bool
     * @throws \App\Containers\User\Tasks\UserNotFoundException
     */
    public function handle(
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
