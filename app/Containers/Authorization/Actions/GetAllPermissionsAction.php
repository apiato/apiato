<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllPermissionsAction extends Action
{
    public function run()
    {
        return Apiato::call('Authorization@GetAllPermissionsTask');
    }
}
