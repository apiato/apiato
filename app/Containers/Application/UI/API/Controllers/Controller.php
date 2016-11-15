<?php

namespace App\Containers\Application\UI\API\Controllers;

use App\Containers\Application\Actions\CreateApplicationWithTokenAction;
use App\Containers\Application\UI\API\Requests\CreateApplicationRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Application\UI\API\Requests\GenerateApplicationTokenRequest $request
     * @param \App\Containers\Application\Actions\GenerateApplicationTokenAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createApplication(
        CreateApplicationRequest $request,
        CreateApplicationWithTokenAction $action
    ) {

        $app = $action->run($request->name, $request->user());

        return $this->response->accepted(null, [
            'application_name'  => $app->name,
            'application_id'    => $app->id,
            'application_token' => $app->token,
        ]);
    }

}
