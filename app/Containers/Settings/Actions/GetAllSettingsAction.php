<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

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
        $settings = Apiato::call('Settings@GetAllSettingsTask', [], ['addRequestCriteria', 'ordered']);

        return $settings;
    }
}
