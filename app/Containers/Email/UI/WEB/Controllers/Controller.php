<?php

namespace App\Containers\Email\UI\WEB\Controllers;

use App\Containers\Email\Actions\ValidateUserEmailByConfirmationCodeAction;
use App\Containers\Email\UI\API\Requests\ConfirmUserEmailRequest;
use App\Port\Controller\Abstracts\PortWebController;
use Illuminate\Support\Facades\Config;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * @param \App\Containers\Email\UI\API\Requests\ConfirmUserEmailRequest $request
     * @param \App\Containers\Email\Actions\ValidateUserEmailByConfirmationCodeAction $action
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmUserEmail(
        ConfirmUserEmailRequest $request,
        ValidateUserEmailByConfirmationCodeAction $action
    ) {
        // validate the confirmation code and update user status is code is valid
        $action->run($request->id, $request->code);

        // redirect to the app URL
        return redirect(Config::get('app.url'));
    }

}
