<?php

namespace Mega\Modules\User\Controllers\Api;

use Mega\Services\Core\Controller\Abstracts\ApiController;
use Mega\Modules\User\Requests\LoginRequest;
use Mega\Modules\User\Tasks\LoginTask;
use Mega\Modules\User\Transformers\UserTransformer;

/**
 * Class LoginController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginController extends ApiController
{
    /**
     * @param \Mega\Modules\User\Requests\LoginRequest $loginRequest
     * @param \Mega\Modules\User\Tasks\LoginTask       $loginTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(LoginRequest $loginRequest, LoginTask $loginTask)
    {
        $user = $loginTask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }
}
