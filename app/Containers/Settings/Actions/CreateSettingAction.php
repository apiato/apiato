<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateSettingAction extends Action
{
    public function run(DataTransporter $data): Setting
    {
        $data = $data->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Apiato::call('Settings@CreateSettingTask', [$data]);

        return $setting;
    }
}
