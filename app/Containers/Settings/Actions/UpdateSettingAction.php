<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\GetSettingByIdTask;
use App\Containers\Settings\Tasks\UpdateSettingTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateSettingAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = $this->call(GetSettingByIdTask::class, [$request->id]);

        $setting = $this->call(UpdateSettingTask::class, [$setting, $data]);

        return $setting;
    }
}
