<?php

namespace App\Containers\Authorization\Actions;

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
        return Apiato::call('Authorization@GetAllPermissionsTask');
    }

}
