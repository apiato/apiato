<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\FindSettingByIdTask;
use App\Containers\Settings\Tasks\UpdateSettingTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

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

        $setting = $this->call(FindSettingByIdTask::class, [$request->id]);

        $setting = $this->call(UpdateSettingTask::class, [$setting, $data]);

        return $setting;
    }
}
