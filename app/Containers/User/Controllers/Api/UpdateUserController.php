<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\UpdateUserRequest;
use App\Containers\User\Subtasks\UpdateUserSubtask;
use App\Containers\User\Transformers\UserTransformer;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class UpdateUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Containers\User\Subtasks\UpdateUserSubtask       $updateUserSubtask
     * @param                                               $userId
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(UpdateUserRequest $updateUserRequest, UpdateUserSubtask $updateUserSubtask, $userId)
    {
        $user = $updateUserSubtask->run(
            $userId,
            $updateUserRequest['password'],
            $updateUserRequest['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
