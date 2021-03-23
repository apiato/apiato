<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Ship\Parents\Actions\Action;

class UpdateSettingAction extends Action
{
    public function run(UpdateSettingRequest $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'key',
            'value'
        ]);

        return Apiato::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);
    }
}
