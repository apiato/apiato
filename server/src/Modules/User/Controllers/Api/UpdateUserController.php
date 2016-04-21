<?php

namespace Mega\Modules\User\Controllers\Api;

use Mega\Modules\User\Requests\UpdateUserRequest;
use Mega\Modules\User\Tasks\UpdateUserTask;
use Mega\Modules\User\Transformers\UserTransformer;
use Mega\Services\Core\Controller\Abstracts\ApiController;

/**
 * Class UpdateUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserController extends ApiController
{
    /**
     * @param \Mega\Modules\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \Mega\Modules\User\Tasks\UpdateUserTask       $updateUserTask
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
