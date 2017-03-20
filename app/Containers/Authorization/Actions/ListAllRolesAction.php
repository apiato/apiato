<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\ListAllRolesTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListAllRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllRolesAction extends Action
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(ListAllRolesTask::class);
    }

}
