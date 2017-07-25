<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\ListSettingsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ListSettingsAction extends Action
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function run(Request $request)
    {
        $settings = $this->call(ListSettingsTask::class, [], ['ordered']);

        return $settings;
    }
}
