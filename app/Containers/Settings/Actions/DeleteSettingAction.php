<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteSettingAction extends Action
{

    /**
     * @param $id
     */
    public function run($id): void
    {
        $setting = Apiato::call('Settings@FindSettingByIdTask', [$id]);

        Apiato::call('Settings@DeleteSettingTask', [$setting]);
    }
}
