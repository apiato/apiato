<?php

namespace App\Containers\Email\UI\API\Controllers;

use App\Containers\Email\Actions\SetUserEmailAction;
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
     * @param \App\Containers\Email\UI\API\Requests\SetEmailRequest $setEmailRequest
     * @param \App\Containers\Email\Actions\SetUserEmailAction   $setUserEmailAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function setUserEmailController(SetUserEmailRequest $setEmailRequest, SetUserEmailAction $setUserEmailAction)
    {
        $setUserEmailAction->run($setEmailRequest->id, $setEmailRequest->email);

        return $this->response->accepted(null, [
            'message' => 'User Email Saved Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\Email\UI\API\Requests\SetEmailRequest $setEmailRequest
     * @param \App\Containers\Email\Actions\SetUserEmailAction   $setUserEmailAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function SetVisitorEmailController(SetVisitorEmailRequest $setEmailRequest, SetVisitorEmailAction $action)
    {
        $action->run($setEmailRequest->header('visitor-id'), $setEmailRequest->email);

        return $this->response->accepted(null, [
            'message' => 'Visitor Email Saved Successfully.',
        ]);
    }
}
