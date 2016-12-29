<?php

namespace App\Containers\Application\UI\API\Controllers;

use App\Containers\Application\Actions\CreateApplicationWithTokenAction;
use App\Containers\Application\Actions\ListAllAppsAction;
use App\Containers\Application\UI\API\Requests\CreateApplicationRequest;
use App\Containers\Application\UI\API\Transformers\ApplicationTransformer;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Application\UI\API\Requests\CreateApplicationRequest $request
     * @param \App\Containers\Application\Actions\CreateApplicationWithTokenAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createApplication(CreateApplicationRequest $request, CreateApplicationWithTokenAction $action)
    {
        $app = $action->run($request->name, $request->user()->id);

        return $this->response->item($app, new ApplicationTransformer());
    }

    /**
     * @param \App\Containers\Application\Actions\ListAllAppsAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listUserApplications(ListAllAppsAction $action)
    {
        $apps = $action->run();

        return $this->response->collection($apps, new ApplicationTransformer());
    }

}
