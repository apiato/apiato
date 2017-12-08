<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Collection;

/**
 * Class GetAllAdminsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdminsAction extends Action
{

    /**
     * @return  Collection
     */
    public function run(): Collection
    {
        return Apiato::call('User@GetAllUsersTask', [], [
            'ordered',
            'admins'
        ]);
    }
}
