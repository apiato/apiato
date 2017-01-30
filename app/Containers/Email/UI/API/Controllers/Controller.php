<?php

namespace App\Containers\Email\UI\API\Controllers;

use App\Containers\Email\Actions\SetUserEmailWithConfirmationAction;
use App\Containers\Email\UI\API\Requests\SetUserEmailRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Email\UI\API\Requests\SetEmailRequest            $request
     * @param \App\Containers\Email\Actions\SetUserEmailWithConfirmationAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function setUserEmailController(SetUserEmailRequest $request, SetUserEmailWithConfirmationAction $action)
    {
        $action->run($request->email);

        return $this->response->accepted(null, [
            'message' => 'User Email Saved Successfully.',
        ]);
    }

}
