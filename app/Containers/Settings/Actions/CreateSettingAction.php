<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Settings\Models\Setting
     */
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
