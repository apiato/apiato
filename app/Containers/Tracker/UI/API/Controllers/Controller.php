<?php

namespace App\Containers\Tracker\UI\API\Controllers;

use App\Containers\Tracker\Actions\TrackCloseAction;
use App\Containers\Tracker\Actions\TrackOpenAction;
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
     * @param \App\Containers\Tracker\Actions\TrackOpenAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function trackOpen(Request $request, TrackOpenAction $action)
    {
        $visitorId = $request->header('visitor-id');

        $action->run($visitorId);

        return $this->response->accepted(null, [
            'message' => 'Session (open) Tracked Successfully.',
        ]);
    }


    /**
     * @param \Dingo\Api\Http\Request                         $request
     * @param \App\Containers\Tracker\Actions\TrackOpenAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function trackClose(Request $request, TrackCloseAction $action)
    {
        $visitorId = $request->header('visitor-id');

        $action->run($visitorId);

        return $this->response->accepted(null, [
            'message' => 'Session (close) Tracked Successfully.',
        ]);
    }

}
