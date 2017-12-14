<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;
use Spatie\Permission\Contracts\Role;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  \Spatie\Permission\Contracts\Role
     */
    public function run(Transporter $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->id]);

        Apiato::call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}
