<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class UpdateSettingTask extends Task
{

    /**
     * @param Setting $setting
     * @param         $data
     *
     * @return mixed
     */
    public function run(Setting $setting, $data)
    {
        return App::make(SettingRepository::class)->update($data, $setting->id);
    }
}
