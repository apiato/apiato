<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListAndSearchUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAndSearchUsersAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(ListUsersTask::class, [], ['ordered']);
    }
}
