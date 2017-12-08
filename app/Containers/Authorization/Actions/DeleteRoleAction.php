<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
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
     * @return  void
     */
    public function run(Request $request): void
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$request->id]);

        Apiato::call('Authorization@DeleteRoleTask', [$role]);
    }
}
