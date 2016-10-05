<?php

namespace App\Containers\Contact\UI\API\Controllers;

use App\Containers\Contact\Actions\SendContactUsEmailAction;
use App\Containers\Contact\UI\API\Requests\ContactUsRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Contact\UI\API\Requests\ContactUsRequest $request
     * @param \App\Containers\Contact\Actions\SendContactUsEmailAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function contactUs(ContactUsRequest $request, SendContactUsEmailAction $action)
    {
        $action->run($request->email, $request->message, $request->subject, $request->name);

        return $this->response->accepted(null, [
            'message' => 'Message sent Successfully.',
        ]);
    }

}
