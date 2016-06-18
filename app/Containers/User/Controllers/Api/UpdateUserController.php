<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\UpdateUserRequest;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\Transformers\UserTransformer;
use App\Containers\Core\Controller\Abstracts\ApiController;

/**
 * Class UpdateUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Containers\User\Tasks\UpdateUserTask       $updateUserTask
     * @param                                               $userId
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(UpdateUserRequest $updateUserRequest, UpdateUserTask $updateUserTask, $userId)
    {
        $user = $updateUserTask->run(
            $userId,
            $updateUserRequest['password'],
            $updateUserRequest['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
