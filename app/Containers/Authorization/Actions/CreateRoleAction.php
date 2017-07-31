<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\CreateRoleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        return $this->call(CreateRoleTask::class, [$request->name, $request->description, $request->display_name]);
    }
}
