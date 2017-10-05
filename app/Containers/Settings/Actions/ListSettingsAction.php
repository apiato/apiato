<?php

namespace App\Containers\Settings\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ListSettingsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $settings = $this->call('Settings@ListSettingsTask', [], ['ordered']);

        return $settings;
    }
}
