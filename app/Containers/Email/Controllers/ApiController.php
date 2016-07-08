<?php

namespace App\Containers\Email\Controllers;

use App\Containers\Email\Requests\SetEmailRequest;
use App\Containers\Email\Actions\SetUserEmailAction;
use App\Port\Controller\Abstracts\KernelApiController;

/**
 * Class ApiController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiController extends KernelApiController
{

    /**
     * @param \App\Containers\Email\Requests\SetEmailRequest $setEmailRequest
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
