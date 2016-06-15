<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Requests\UpdateUserRequest;
use App\Modules\User\Tasks\UpdateUserTask;
use App\Modules\User\Transformers\UserTransformer;
use App\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class UpdateUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserController extends ApiController
{

    /**
     * @param \App\Modules\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Modules\User\Tasks\UpdateUserTask       $updateUserTask
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
