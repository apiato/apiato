<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\RegisterRequest;
use App\Containers\User\Subtasks\CreateUserSubtask;
use App\Containers\User\Transformers\UserTransformer;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class RegisterController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\RegisterRequest  $registerRequest
     * @param \App\Containers\User\Subtasks\AssignUserRolesSubtask $assignUserRolesSubtask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(
        RegisterRequest $registerRequest,
        CreateUserSubtask $createUserSubtask
    ) {

        // create and login (true parameter) the new user
        $user = $createUserSubtask->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }
}
