<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Ship\Parents\Actions\Action;

class GetAllRolesAction extends Action
{
    public function run()
    {
        return Apiato::call(GetAllRolesTask::class);
    }
}
