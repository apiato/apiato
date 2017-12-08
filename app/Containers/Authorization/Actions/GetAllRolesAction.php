<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

/**
 * Class GetAllRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllRolesAction extends Action
{

    /**
     * @return Collection
     */
    public function run(): Collection
    {
        $roles = Apiato::call('Authorization@GetAllRolesTask');

        return $roles;
    }

}
