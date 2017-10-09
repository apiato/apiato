<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\GetAllSettingsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllSettingsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $settings = $this->call(GetAllSettingsTask::class, [], ['ordered']);

        return $settings;
    }
}
