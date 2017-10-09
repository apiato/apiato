<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllAndSearchUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAndSearchUsersAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(GetAllUsersTask::class, [], ['ordered']);
    }
}
