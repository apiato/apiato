<?php

namespace App\Containers\Email\Controllers\Api;

use App\Containers\Email\Requests\SetEmailRequest;
use App\Containers\Email\Tasks\SetUserEmailTask;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class SetUserEmailController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailController extends ApiController
{

    /**
     * @param \App\Containers\Email\Requests\SetEmailRequest $setEmailRequest
     * @param \App\Containers\Email\Tasks\SetUserEmailTask   $setUserEmailTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function handle(SetEmailRequest $setEmailRequest, SetUserEmailTask $setUserEmailTask)
    {
        $setUserEmailTask->run($setEmailRequest->id, $setEmailRequest->email);

        return $this->response->accepted(null, [
            'message' => 'User Email Sent Successfully, Waiting User Email Confirmation.',
        ]);
    }
}
