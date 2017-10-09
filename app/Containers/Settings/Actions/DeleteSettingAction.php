<?php

namespace App\Containers\Settings\Actions;

<<<<<<< HEAD
use App\Containers\Settings\Tasks\DeleteSettingTask;
use App\Containers\Settings\Tasks\FindSettingByIdTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD
        $setting = $this->call(FindSettingByIdTask::class, [$request->id]);
=======
        $setting = Apiato::call('Settings@GetSettingByIdTask', [$request->id]);
>>>>>>> apiato

        $result = Apiato::call('Settings@DeleteSettingTask', [$setting]);

        return $result;
    }
}
