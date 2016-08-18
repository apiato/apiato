<?php

namespace App\Containers\Tracker\UI\API\Controllers;

use App\Containers\Tracker\Actions\CloseTimeTrackAction;
use App\Containers\Tracker\Actions\OpenTimeTrackAction;
use App\Port\Controller\Abstracts\PortApiController;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \Dingo\Api\Http\Request                         $request
     * @param \App\Containers\Tracker\Actions\OpenTimeTrackAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function trackOpen(Request $request, OpenTimeTrackAction $action)
    {
        $visitorId = $request->header('visitor-id');

        $action->run($visitorId);

        return $this->response->accepted(null, [
            'message' => 'Session (open) Tracked Successfully.',
        ]);
    }


    /**
     * @param \Dingo\Api\Http\Request                         $request
     * @param \App\Containers\Tracker\Actions\OpenTimeTrackAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function trackClose(Request $request, CloseTimeTrackAction $action)
    {
        $visitorId = $request->header('visitor-id');

        $action->run($visitorId);

        return $this->response->accepted(null, [
            'message' => 'Session (close) Tracked Successfully.',
        ]);
    }

}
