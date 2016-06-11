<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Requests\DeleteUserRequest;
use Hello\Modules\User\Tasks\DeleteUserTask;
use Hello\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class DeleteUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserController extends ApiController
{

    /**
     * @param \Hello\Modules\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \Hello\Modules\User\Tasks\DeleteUserTask       $deleteUserTask
     * @param                                               $userId
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(DeleteUserRequest $deleteUserRequest, DeleteUserTask $deleteUserTask, $userId)
    {
        $deleteUserTask->run($userId);

        return $this->response->accepted(null, [
            'message' => 'User (' . $userId . ') Deleted Successfully.',
        ]);
    }
}
