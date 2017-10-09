<?php

namespace App\Containers\User\Actions;

<<<<<<< HEAD:app/Containers/User/Actions/GetAllAndSearchUsersAction.php
use App\Containers\User\Tasks\GetAllUsersTask;
=======
>>>>>>> apiato:app/Containers/User/Actions/ListAndSearchUsersAction.php
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
<<<<<<< HEAD:app/Containers/User/Actions/GetAllAndSearchUsersAction.php
        return $this->call(GetAllUsersTask::class, [], ['ordered']);
=======
        return Apiato::call('User@ListUsersTask', [], ['ordered']);
>>>>>>> apiato:app/Containers/User/Actions/ListAndSearchUsersAction.php
    }
}
