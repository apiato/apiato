<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Requests\UpdateUserRequest;
use Hello\Modules\User\Tasks\UpdateUserTask;
use Hello\Modules\User\Transformers\UserTransformer;
use Hello\Services\Core\Controller\Abstracts\ApiController;

/**
 * Class UpdateUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserController extends ApiController
{

    /**
     * @param \Hello\Modules\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \Hello\Modules\User\Tasks\UpdateUserTask       $updateUserTask
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
