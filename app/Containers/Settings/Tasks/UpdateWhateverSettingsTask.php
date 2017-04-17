<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UpdateWhateverSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateWhateverSettingsTask extends Task
{

    /**
     * @param $value
     *
     * @return  mixed
     */
    public function run($value)
    {
        // TODO: replace both queries with a single UpdateWhere instead of find and update.
        //       this UpdateWhere will need to be added to the repository package (contribution).

        $key = 'whatever';

        $settingsRepository = App::make(SettingsRepository::class);

        $setting = $settingsRepository->findWhere(['key' => $key])->first();

        return $settingsRepository->update([
            'value' => $value
        ], $setting->id);

    }

}
