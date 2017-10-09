<?php

namespace App\Containers\User\Actions;

<<<<<<< HEAD:app/Containers/User/Actions/GetAllAdminsAction.php
use App\Containers\User\Tasks\GetAllUsersTask;
=======
>>>>>>> apiato:app/Containers/User/Actions/ListAdminsAction.php
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllAdminsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdminsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
<<<<<<< HEAD:app/Containers/User/Actions/GetAllAdminsAction.php
        return $this->call(GetAllUsersTask::class, [], [
            'ordered', 'admins'
=======
        return Apiato::call('User@ListUsersTask', [], [
            'ordered',
            'admins'
>>>>>>> apiato:app/Containers/User/Actions/ListAdminsAction.php
        ]);
    }
}
