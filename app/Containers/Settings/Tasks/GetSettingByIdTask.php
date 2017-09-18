<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Parents\Tasks\Task;

class GetSettingByIdTask extends Task
{

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        $setting = App::make(SettingRepository::class)->find($id);

        if (!$setting) {
            throw new SettingNotFoundException();
        }

        return $setting;
    }
}
