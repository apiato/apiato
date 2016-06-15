<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Requests\RegisterRequest;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Transformers\UserTransformer;
use App\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class RegisterController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \App\Modules\User\Requests\RegisterRequest  $registerRequest
     * @param \App\Modules\User\Tasks\AssignUserRolesTask $assignUserRolesTask
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
