<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsAction extends Action
{
    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->call(GetAllPermissionsTask::class);
    }

}
