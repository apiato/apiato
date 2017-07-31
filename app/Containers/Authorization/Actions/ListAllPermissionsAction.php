<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\ListAllPermissionsTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ListAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllPermissionsAction extends Action
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(ListAllPermissionsTask::class);
    }

}
