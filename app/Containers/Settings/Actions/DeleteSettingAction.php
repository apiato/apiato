<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteSettingAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  void
     */
    public function run(Request $request) : void
    {
        $setting = Apiato::call('Settings@FindSettingByIdTask', [$request->id]);

        Apiato::call('Settings@DeleteSettingTask', [$setting]);
    }
}
