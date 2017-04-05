<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListAdminsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAdminsAction extends Action
{

    /**
     * @param bool $order
     *
     * @return  mixed
     */
    public function run($order = true)
    {
        $users = $this->call(ListUsersTask::class, [$order, false, ['admin']]);

        return $users;
    }
}
