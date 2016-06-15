<?php

namespace App\Modules\User\Controllers\Api;

use App\Modules\User\Tasks\ListAllUsersTask;
use App\Modules\User\Transformers\UserTransformer;
use App\Modules\Core\Controller\Abstracts\ApiController;

/**
 * Class ListAllUsersController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersController extends ApiController
{

    /**
     * @param \App\Modules\User\Tasks\ListAllUsersTask $listAllUsersTask
     *
     * @return \Dingo\Api\Http\Response
     */
    public function handle(ListAllUsersTask $listAllUsersTask)
    {
        $users = $listAllUsersTask->run();

        return $this->response->paginator($users, new UserTransformer());
    }
}
