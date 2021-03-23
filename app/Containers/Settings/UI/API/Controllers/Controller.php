<?php

namespace App\Containers\Settings\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\UI\API\Requests\CreateSettingRequest;
use App\Containers\Settings\UI\API\Requests\DeleteSettingRequest;
use App\Containers\Settings\UI\API\Requests\GetAllSettingsRequest;
use App\Containers\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Containers\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getAllSettings(GetAllSettingsRequest $request): array
    {
        $settings = Apiato::call('Settings@GetAllSettingsAction');
        return $this->transform($settings, SettingTransformer::class);
    }

    public function createSetting(CreateSettingRequest $request): array
    {
        $setting = Apiato::call('Settings@CreateSettingAction', [$request]);
        return $this->transform($setting, SettingTransformer::class);
    }

    public function updateSetting(UpdateSettingRequest $request): array
    {
        $setting = Apiato::call('Settings@UpdateSettingAction', [$request]);
        return $this->transform($setting, SettingTransformer::class);
    }

    public function deleteSetting(DeleteSettingRequest $request): JsonResponse
    {
        Apiato::call('Settings@DeleteSettingAction', [$request]);
        return $this->noContent();
    }
}
