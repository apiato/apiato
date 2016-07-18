<?php

namespace App\Containers\Email\UI\API\Controllers;

use App\Containers\Email\UI\API\Requests\SetEmailRequest;
use App\Containers\Email\Actions\SetUserEmailAction;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class ApiController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiController extends PortApiController
{

    /**
     * @param \App\Containers\Email\UI\API\Requests\SetEmailRequest $setEmailRequest
     * @param \App\Containers\Email\Actions\SetUserEmailAction   $setUserEmailAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function setUserEmailController(SetEmailRequest $setEmailRequest, SetUserEmailAction $setUserEmailAction)
    {
        $setUserEmailAction->run($setEmailRequest->id, $setEmailRequest->email);

        return $this->response->accepted(null, [
            'message' => 'User Email Sent Successfully, Waiting User Email Confirmation.',
        ]);
    }
}
