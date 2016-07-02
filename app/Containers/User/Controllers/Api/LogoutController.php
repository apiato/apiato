<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Subtasks\ApiLogoutSubtask;
use App\Kernel\Controller\Abstracts\ApiController;
use App\Kernel\Request\Manager\HttpRequest;

/**
 * Class LogoutController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutController extends ApiController
{

    /**
     * @param \App\Kernel\Request\Manager\HttpRequest $request
     * @param \App\Containers\User\Subtasks\ApiLogoutSubtask             $logoutSubtask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(HttpRequest $request, ApiLogoutSubtask $logoutSubtask)
    {
        $logoutSubtask->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }
}
