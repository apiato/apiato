<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\LoginRequest;
use App\Containers\User\Subtasks\ApiLoginSubtask;
use App\Containers\User\Transformers\UserTransformer;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class LoginController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\LoginRequest $loginRequest
     * @param \App\Containers\User\Subtasks\ApiLoginSubtask       $loginSubtask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(LoginRequest $loginRequest, ApiLoginSubtask $loginSubtask)
    {
        $user = $loginSubtask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }
}
