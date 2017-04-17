<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        return $this->call(CreatePermissionTask::class, [$request->name, $request->description, $request->display_name]);
    }
}
