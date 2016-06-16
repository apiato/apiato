<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Tasks\ApiLogoutTask;
use App\Modules\Core\Controller\Abstracts\ApiController;
use App\Modules\Core\Request\Manager\HttpRequest;

/**
 * Class LogoutController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutController extends ApiController
{

    /**
     * @param \App\Modules\Core\Request\Manager\HttpRequest $request
     * @param \App\Modules\User\Tasks\ApiLogoutTask             $logoutTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(HttpRequest $request, ApiLogoutTask $logoutTask)
    {
        $logoutTask->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }
}
