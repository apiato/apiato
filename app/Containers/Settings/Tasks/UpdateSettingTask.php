<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class UpdateSettingTask extends Task
{

    /**
     * @param $settingId
     * @param $data
     *
     * @return  mixed
     */
    public function run($settingId, $data)
    {
        return App::make(SettingRepository::class)->update($data, $settingId);
    }
}
