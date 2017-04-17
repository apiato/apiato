<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindWhateverSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindWhateverSettingsTask extends Task
{
    /**
     * @return  mixed
     */
    public function run()
    {
        $settingsName = 'whatever';

        $result = App::make(SettingsRepository::class)->findWhere(['key' => $settingsName])->first();

        return $result->value;
    }

}
