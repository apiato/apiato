<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateSettingAction extends Action
{

    /**
     * @param $sanitizedData
     *
     * @return  \App\Containers\Settings\Models\Setting
     */
    public function run($sanitizedData): Setting
    {
        $setting = Apiato::call('Settings@CreateSettingTask', [$sanitizedData]);

        return $setting;
    }
}
