<?php

namespace App\Containers\Settings\UI\API\Controllers;

use App\Containers\Settings\Actions\CreateSettingAction;
use App\Containers\Settings\Actions\DeleteSettingAction;
use App\Containers\Settings\Actions\ListSettingsAction;
use App\Containers\Settings\Actions\UpdateSettingAction;
use App\Containers\Settings\UI\API\Requests\CreateSettingRequest;
use App\Containers\Settings\UI\API\Requests\DeleteSettingRequest;
use App\Containers\Settings\UI\API\Requests\ListAllSettingsRequest;
use App\Containers\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Containers\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{
    /**
     * List all application settings
     *
     * @param ListAllSettingsRequest $request
     *
     * @return mixed
     */
    public function listAllSettings(ListAllSettingsRequest $request)
    {
        $settings = $this->call(ListSettingsAction::class, [$request]);

        return $this->transform($settings, SettingTransformer::class);
    }

    /**
     * create a new setting
     *
     * @param CreateSettingRequest $request
     *
     * @return mixed
     */
    public function createSetting(CreateSettingRequest $request)
    {
        $setting = $this->call(CreateSettingAction::class, [$request]);

        return $this->transform($setting, SettingTransformer::class);
    }

    /**
     * Updates an existing setting
     *
     * @param UpdateSettingRequest $request
     *
     * @return mixed
     */
    public function updateSetting(UpdateSettingRequest $request)
    {
        $setting = $this->call(UpdateSettingAction::class, [$request]);

        return $this->transform($setting, SettingTransformer::class);
    }

    /**
     * Removes a setting
     *
     * @param DeleteSettingRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSetting(DeleteSettingRequest $request)
    {
        $setting = $this->call(DeleteSettingAction::class, [$request]);

        return $this->noContent();
    }
}
