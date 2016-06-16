<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Requests\LoginRequest;
use App\Modules\User\Tasks\ApiLoginTask;
use App\Modules\User\Transformers\UserTransformer;
use App\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class LoginController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginController extends ApiController
{

    /**
     * @param \App\Modules\User\Requests\LoginRequest $loginRequest
     * @param \App\Modules\User\Tasks\ApiLoginTask       $loginTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(LoginRequest $loginRequest, ApiLoginTask $loginTask)
    {
        $user = $loginTask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }
}
