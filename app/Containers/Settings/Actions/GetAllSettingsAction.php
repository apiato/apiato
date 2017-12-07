<?php

namespace App\Containers\Settings\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllSettingsAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllSettingsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $settings = Apiato::call('Settings@GetAllSettingsTask', [], ['ordered']);

        return $settings;
    }
}
