<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\DeleteSettingTask;
use App\Containers\Settings\Tasks\GetSettingByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteSettingAction extends Action
{
    public function run(Request $request)
    {
        $setting = $this->call(GetSettingByIdTask::class, [$request->id]);

        $result = $this->call(DeleteSettingTask::class, [$setting]);

        return $result;
    }
}
