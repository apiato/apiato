<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllSettingsAction extends Action
{
    public function run()
    {
        return Apiato::call('Settings@GetAllSettingsTask', [], ['ordered']);
    }
}
