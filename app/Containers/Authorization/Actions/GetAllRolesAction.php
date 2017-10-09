<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

/**
 * Class GetAllRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllRolesAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return App::make(RoleRepository::class)->all();
    }

}
