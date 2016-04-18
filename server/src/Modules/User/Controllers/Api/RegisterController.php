<?php

namespace Mega\Modules\User\Controllers\Api;

use JWTAuth;
use Mega\Services\Core\Controller\Abstracts\ApiController;
use Mega\Modules\User\Requests\RegisterRequest;
use Mega\Modules\User\Tasks\AssignUserRolesTask;
use Mega\Modules\User\Tasks\CreateUserTask;
use Mega\Modules\User\Transformers\UserTransformer;

/**
 * Class RegisterController
 *
 * @type Controller
 * @package  Mega\Interfaces\Api\Controllers
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \Mega\Modules\User\Requests\RegisterRequest $registerRequest
     * @param \Mega\Modules\User\Tasks\CreateUserTask     $createUserTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(
        RegisterRequest $registerRequest,
        CreateUserTask $createUserTask,
        AssignUserRolesTask $assignUserRolesTask
    ) {

        // create and login (true parameter) the new user
        $user = $createUserTask->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        $user = $assignUserRolesTask->run($user);

        return $this->response->item($user, new UserTransformer());
    }


}
