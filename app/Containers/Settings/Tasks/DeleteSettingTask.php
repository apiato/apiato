<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class DeleteSettingTask extends Task
{

    /**
     * @param Setting $setting
     *
     * @return int
     */
    public function run(Setting $setting)
    {
        return App::make(SettingRepository::class)->delete($setting->id);
    }
}
