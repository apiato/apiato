<?php

namespace Mega\Modules\User\Controllers\Api;

use Mega\Services\Core\Controller\Abstracts\ApiController;
use Mega\Services\Core\Request\Manager\HttpRequest;
use Mega\Modules\User\Tasks\LogoutTask;

/**
 * Class LogoutController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutController extends ApiController
{
    /**
     * @param \Dingo\Api\Http\Request             $request
     * @param \Mega\Modules\User\Tasks\LogoutTask $logoutTask
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
