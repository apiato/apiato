<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DeleteSettingAction extends Action
{
    public function run(DataTransporter $data): void
    {
        $setting = Apiato::call('Settings@FindSettingByIdTask', [$data->id]);

        Apiato::call('Settings@DeleteSettingTask', [$setting]);
    }
}
