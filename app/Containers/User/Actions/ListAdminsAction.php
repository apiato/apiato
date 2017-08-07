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
     * @return  mixed
     */
    public function run()
    {
        return $this->call(ListUsersTask::class, [], [
            'ordered', 'admins'
        ]);
    }
}
