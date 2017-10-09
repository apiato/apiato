<?php

namespace App\Containers\User\Actions;

<<<<<<< HEAD:app/Containers/User/Actions/GetAllClientsAction.php
use App\Containers\User\Tasks\GetAllUsersTask;
=======
>>>>>>> apiato:app/Containers/User/Actions/ListClientsAction.php
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllClientsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllClientsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
<<<<<<< HEAD:app/Containers/User/Actions/GetAllClientsAction.php
        return $this->call(GetAllUsersTask::class, [], [
            'ordered', 'clients'
=======
        return Apiato::call('User@ListUsersTask', [], [
            'ordered',
            'clients'
>>>>>>> apiato:app/Containers/User/Actions/ListClientsAction.php
        ]);
    }
}
