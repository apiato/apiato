<?php

namespace App\Containers\Settings\Actions;

<<<<<<< HEAD:app/Containers/Settings/Actions/GetAllSettingsAction.php
use App\Containers\Settings\Tasks\GetAllSettingsTask;
=======
>>>>>>> apiato:app/Containers/Settings/Actions/ListSettingsAction.php
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

<<<<<<< HEAD:app/Containers/Settings/Actions/GetAllSettingsAction.php
class GetAllSettingsAction extends Action
=======
/**
 * Class ListSettingsAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ListSettingsAction extends Action
>>>>>>> apiato:app/Containers/Settings/Actions/ListSettingsAction.php
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD:app/Containers/Settings/Actions/GetAllSettingsAction.php
        $settings = $this->call(GetAllSettingsTask::class, [], ['ordered']);
=======
        $settings = Apiato::call('Settings@ListSettingsTask', [], ['ordered']);
>>>>>>> apiato:app/Containers/Settings/Actions/ListSettingsAction.php

        return $settings;
    }
}
