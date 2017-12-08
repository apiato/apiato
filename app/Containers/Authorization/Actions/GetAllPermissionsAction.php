<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Collection;

/**
 * Class GetAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsAction extends Action
{

    /**
     * @return  Collection
     */
    public function run(): Collection
    {
        $permissions = Apiato::call('Authorization@GetAllPermissionsTask');

        return $permissions;
    }

}
