<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllRolesAction extends Action
{
    public function run()
    {
        return Apiato::call('Authorization@GetAllRolesTask');
    }
}
