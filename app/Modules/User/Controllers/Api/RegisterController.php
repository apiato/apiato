<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Requests\RegisterRequest;
use Hello\Modules\User\Tasks\CreateUserTask;
use Hello\Modules\User\Transformers\UserTransformer;
use Hello\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class RegisterController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \Hello\Modules\User\Requests\RegisterRequest  $registerRequest
     * @param \Hello\Modules\User\Tasks\AssignUserRolesTask $assignUserRolesTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(
        RegisterRequest $registerRequest,
        CreateUserTask $createUserTask
    ) {

        // create and login (true parameter) the new user
        $user = $createUserTask->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }
}
