<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call('Authorization@GetRoleTask', [$request->id]);
        $this->call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}
