<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\CreateSettingTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateSettingAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = $this->call(CreateSettingTask::class, [$data]);

        return $setting;
    }
}
