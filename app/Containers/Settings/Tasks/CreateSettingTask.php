<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class CreateSettingTask extends Task
{

    /**
     * @param array $data
     *
     * @return  \App\Containers\Settings\Models\Setting
     */
    public function run(array $data): Setting
    {
        return App::make(SettingRepository::class)->create($data);
    }
}
