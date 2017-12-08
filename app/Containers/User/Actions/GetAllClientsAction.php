<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

/**
 * Class GetAllClientsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllClientsAction extends Action
{

    /**
     * @return  Collection
     */
    public function run(): Collection
    {
        return Apiato::call('User@GetAllUsersTask', [], [
            'ordered',
            'clients'
        ]);
    }
}
