<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllAndSearchUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAndSearchUsersAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return Apiato::call('User@GetAllUsersTask', [], ['ordered']);
    }
}
