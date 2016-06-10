<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Requests\LoginRequest;
use Hello\Modules\User\Tasks\LoginTask;
use Hello\Modules\User\Transformers\UserTransformer;
use Hello\Services\Core\Controller\Abstracts\ApiController;

/**
 * Class LoginController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginController extends ApiController
{

    /**
     * @param \Hello\Modules\User\Requests\LoginRequest $loginRequest
     * @param \Hello\Modules\User\Tasks\LoginTask       $loginTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(LoginRequest $loginRequest, LoginTask $loginTask)
    {
        $user = $loginTask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }
}
