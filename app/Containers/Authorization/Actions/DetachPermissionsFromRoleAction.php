<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call('Authorization@GetRoleTask', [$request->role_id]);

        return $this->call('Authorization@DetachPermissionsFromRoleTask', [$role, $request->permissions_ids]);
    }
}
