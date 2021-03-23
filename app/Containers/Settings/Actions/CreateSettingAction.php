<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\Setting;
use App\Containers\Settings\UI\API\Requests\CreateSettingRequest;
use App\Ship\Parents\Actions\Action;

class CreateSettingAction extends Action
{
    public function run(CreateSettingRequest $data): Setting
    {
        $sanitizedData = $data->sanitizeInput([
            'key',
            'value'
        ]);

        return Apiato::call('Settings@CreateSettingTask', [$sanitizedData]);
    }
}
