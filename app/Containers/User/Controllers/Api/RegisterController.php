<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\RegisterRequest;
use App\Containers\User\Tasks\CreateUserTask;
use App\Containers\User\Transformers\UserTransformer;
use App\Engine\Controller\Abstracts\ApiController;

/**
 * Class RegisterController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\RegisterRequest  $registerRequest
     * @param \App\Containers\User\Tasks\AssignUserRolesTask $assignUserRolesTask
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
