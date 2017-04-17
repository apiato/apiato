<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UpdateSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingsByKeyTask extends Task
{
    /**
     * @param $key
     * @param $value
     *
     * @return  mixed
     */
    public function run($key, $value)
    {
        // TODO: replace both queries with a single UpdateWhere instead of find and update.
        // this UpdateWhere needs to be added to the repository package (contribution).

        $settingsRepository = App::make(SettingsRepository::class);

        $setting = $settingsRepository->findWhere(['key' => $key])->first();

        return $settingsRepository->update([
            'value' => $value
        ], $setting->id);
    }

}
