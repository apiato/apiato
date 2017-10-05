<?php

namespace App\Containers\Settings\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateSettingAction extends Action
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

        $setting = $this->call('Settings@CreateSettingTask', [$data]);

        return $setting;
    }
}
