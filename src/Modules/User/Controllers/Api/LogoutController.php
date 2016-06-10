<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Tasks\LogoutTask;
use Hello\Services\Core\Controller\Abstracts\ApiController;
use Hello\Services\Core\Request\Manager\HttpRequest;

/**
 * Class LogoutController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutController extends ApiController
{

    /**
     * @param \Hello\Services\Core\Request\Manager\HttpRequest $request
     * @param \Hello\Modules\User\Tasks\LogoutTask             $logoutTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(HttpRequest $request, LogoutTask $logoutTask)
    {
        $logoutTask->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }
}
