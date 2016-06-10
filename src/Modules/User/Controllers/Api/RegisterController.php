<?php

namespace Mega\Modules\User\Controllers\Api;

use Mega\Modules\User\Requests\RegisterRequest;
use Mega\Modules\User\Tasks\CreateUserTask;
use Mega\Modules\User\Transformers\UserTransformer;
use Mega\Services\Core\Controller\Abstracts\ApiController;

/**
 * Class RegisterController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterController extends ApiController
{

    /**
     * @param \Mega\Modules\User\Requests\RegisterRequest  $registerRequest
     * @param \Mega\Modules\User\Tasks\AssignUserRolesTask $assignUserRolesTask
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
