<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Requests\DeleteUserRequest;
use App\Modules\User\Tasks\DeleteUserTask;
use App\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class DeleteUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserController extends ApiController
{

    /**
     * @param \App\Modules\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \App\Modules\User\Tasks\DeleteUserTask       $deleteUserTask
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
