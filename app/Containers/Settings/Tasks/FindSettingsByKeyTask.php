<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class FindSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingsByKeyTask extends Task
{
    /**
     * @param $key
     *
     * @return  mixed
     */
    public function run($key)
    {
        $result = App::make(SettingsRepository::class)->findWhere(['key' => $key])->first();

        return $result->value;
    }

}
