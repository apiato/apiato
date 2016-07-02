<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Subtasks\ListAllUsersSubtask;
use App\Containers\User\Transformers\UserTransformer;
use App\Kernel\Controller\Abstracts\ApiController;

/**
 * Class ListAllUsersController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersController extends ApiController
{

    /**
     * @param \App\Containers\User\Subtasks\ListAllUsersSubtask $listAllUsersSubtask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(ListAllUsersSubtask $listAllUsersSubtask)
    {
        $users = $listAllUsersSubtask->run();

        return $this->response->paginator($users, new UserTransformer());
    }
}
