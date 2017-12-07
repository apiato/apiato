<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param $id
     * @param $sanitizedData
     *
     * @return  mixed
     */
    public function run($id, $sanitizedData)
    {
        $setting = Apiato::call('Settings@UpdateSettingTask', [$id, $sanitizedData]);

        return $setting;
    }
}
