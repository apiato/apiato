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
     * @param null $roles
     * @param bool $order
     *
     * @return  mixed
     */
    public function run($roles = null, $order = true)
    {
        $users = $this->call(ListUsersTask::class, [$order, $roles]);

        return $users;
    }
}
