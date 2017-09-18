<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class CreateSettingTask extends Task
{

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function run(array $data)
    {
        return App::make(SettingRepository::class)->create($data);
    }
}
