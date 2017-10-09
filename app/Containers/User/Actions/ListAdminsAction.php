<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

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
        return Apiato::call('User@ListUsersTask', [], [
            'ordered',
            'admins'
        ]);
    }
}
