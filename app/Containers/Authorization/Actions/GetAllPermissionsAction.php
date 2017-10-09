<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD:app/Containers/Authorization/Actions/GetAllPermissionsAction.php
use App\Containers\Authorization\Tasks\GetAllPermissionsTask;
=======
>>>>>>> apiato:app/Containers/Authorization/Actions/ListAllPermissionsAction.php
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
<<<<<<< HEAD:app/Containers/Authorization/Actions/GetAllPermissionsAction.php
        return $this->call(GetAllPermissionsTask::class);
=======
        return Apiato::call('Authorization@ListAllPermissionsTask');
>>>>>>> apiato:app/Containers/Authorization/Actions/ListAllPermissionsAction.php
    }

}
