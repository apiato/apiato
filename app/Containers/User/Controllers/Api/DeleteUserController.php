<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Requests\DeleteUserRequest;
use App\Containers\User\Subtasks\DeleteUserSubtask;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class DeleteUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserController extends ApiController
{

    /**
     * @param \App\Containers\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \App\Containers\User\Subtasks\DeleteUserSubtask       $deleteUserSubtask
     * @param                                               $userId
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(DeleteUserRequest $deleteUserRequest, DeleteUserSubtask $deleteUserSubtask, $userId)
    {
        $deleteUserSubtask->run($userId);

        return $this->response->accepted(null, [
            'message' => 'User (' . $userId . ') Deleted Successfully.',
        ]);
    }
}
