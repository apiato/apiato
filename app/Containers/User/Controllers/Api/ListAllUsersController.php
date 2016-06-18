<?php

namespace App\Containers\User\Controllers\Api;

use App\Containers\User\Tasks\ListAllUsersTask;
use App\Containers\User\Transformers\UserTransformer;
use App\Containers\Core\Controller\Abstracts\ApiController;

/**
 * Class ListAllUsersController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersController extends ApiController
{

    /**
     * @param \App\Containers\User\Tasks\ListAllUsersTask $listAllUsersTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(ListAllUsersTask $listAllUsersTask)
    {
        $users = $listAllUsersTask->run();

        return $this->response->paginator($users, new UserTransformer());
    }
}
