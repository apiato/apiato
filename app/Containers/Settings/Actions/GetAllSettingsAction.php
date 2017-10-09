<?php

namespace App\Containers\Settings\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class ListSettingsAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ListSettingsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $settings = Apiato::call('Settings@ListSettingsTask', [], ['ordered']);

        return $settings;
    }
}
