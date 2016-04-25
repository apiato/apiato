<?php

namespace Mega\Modules\User\Controllers\Api;

use Mega\Modules\User\Requests\DeleteUserRequest;
use Mega\Modules\User\Tasks\DeleteUserTask;
use Mega\Services\Core\Controller\Abstracts\ApiController;

/**
 * Class DeleteUserController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserController extends ApiController
{

    /**
     * @param \Mega\Modules\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \Mega\Modules\User\Tasks\DeleteUserTask       $deleteUserTask
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
