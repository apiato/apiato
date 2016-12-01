<?php

namespace App\Containers\Email\UI\API\Controllers;

use App\Containers\Email\Actions\SetUserEmailWithConfirmationAction;
use App\Containers\Email\Actions\SetVisitorEmailAction;
use App\Containers\Email\UI\API\Requests\SetUserEmailRequest;
use App\Containers\Email\UI\API\Requests\SetVisitorEmailRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Email\UI\API\Requests\SetEmailRequest $request
     * @param \App\Containers\Email\Actions\SetUserEmailWithConfirmationAction   $action
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

    /**
     * @param \App\Containers\Email\UI\API\Requests\SetVisitorEmailRequest $request
     * @param \App\Containers\Email\Actions\SetVisitorEmailAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function SetVisitorEmailController(SetVisitorEmailRequest $request, SetVisitorEmailAction $action)
    {
        $action->run($request->header('visitor-id'), $request->email);

        return $this->response->accepted(null, [
            'message' => 'Visitor Email Saved Successfully.',
        ]);
    }
}
