<?php

namespace App\Containers\Settings\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteSettingAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $setting = $this->call('Settings@GetSettingByIdTask', [$request->id]);

        $result = $this->call('Settings@DeleteSettingTask', [$setting]);

        return $result;
    }
}
