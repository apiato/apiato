<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdateSettingAction extends Action
{
    public function run(DataTransporter $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Apiato::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);

        return $setting;
    }
}
