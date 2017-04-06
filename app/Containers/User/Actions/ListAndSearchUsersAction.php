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
     * @param bool $order
     *
     * @return  mixed
     */
    public function run($order = true)
    {
        $users = $this->call(ListUsersTask::class, [$order, true]);

        return $users;
    }
}
