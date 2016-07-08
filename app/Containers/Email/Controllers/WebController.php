<?php

namespace App\Containers\Email\Controllers;

use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\Email\Actions\ValidateConfirmationCodeAction;
use App\Containers\User\Actions\FindUserByIdAction;
use App\Port\Controller\Abstracts\PortWebController;

/**
 * Class WebController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebController extends PortWebController
{

    /**
     * @param \App\Containers\Email\Requests\ConfirmUserEmailRequest       $confirmUserEmailRequest
     * @param \App\Containers\User\Actions\FindUserByIdAction              $findUserByIdAction
     * @param \App\Containers\Email\Actions\ValidateConfirmationCodeAction $validateConfirmationCodeAction
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmUserEmail(
        ConfirmUserEmailRequest $confirmUserEmailRequest,
        FindUserByIdAction $findUserByIdAction,
        ValidateConfirmationCodeAction $validateConfirmationCodeAction
    ) {

        // find user by ID
        $user = $findUserByIdAction->run($confirmUserEmailRequest->id);

        // validate the confirmation code and update user status is code is valid
        $validateConfirmationCodeAction->run($user, $confirmUserEmailRequest->code);

        // redirect to the app URL
        return redirect(env('APP_FULL_URL'));
    }

}
