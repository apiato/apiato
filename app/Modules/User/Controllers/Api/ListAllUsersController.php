<?php

namespace Hello\Modules\User\Controllers\Api;

use Hello\Modules\User\Tasks\ListAllUsersTask;
use Hello\Modules\User\Transformers\UserTransformer;
use Hello\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class ListAllUsersController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersController extends ApiController
{

    /**
     * @param \Hello\Modules\User\Tasks\ListAllUsersTask $listAllUsersTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(ListAllUsersTask $listAllUsersTask)
    {
        $users = $listAllUsersTask->run();

        return $this->response->paginator($users, new UserTransformer());
    }
}
