<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListClientsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListClientsAction extends Action
{

    /**
     * @param bool $order
     *
     * @return  mixed
     */
    public function run($order = true)
    {
        return $this->call(ListUsersTask::class, [$order, false, []]);
    }
}
