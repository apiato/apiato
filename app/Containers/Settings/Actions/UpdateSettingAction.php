<?php

namespace App\Containers\Settings\Actions;

<<<<<<< HEAD
use App\Containers\Settings\Tasks\FindSettingByIdTask;
use App\Containers\Settings\Tasks\UpdateSettingTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'key',
            'value'
        ]);

<<<<<<< HEAD
        $setting = $this->call(FindSettingByIdTask::class, [$request->id]);
=======
        $setting = Apiato::call('Settings@GetSettingByIdTask', [$request->id]);
>>>>>>> apiato

        $setting = Apiato::call('Settings@UpdateSettingTask', [$setting, $data]);

        return $setting;
    }
}
