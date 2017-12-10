<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  mixed
     */
    public function run(Transporter $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Apiato::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);

        return $setting;
    }
}
