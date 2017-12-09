<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

class DeleteSettingTask extends Task
{

    /**
     * @param Setting $setting
     *
     * @return int
     * @throws DeleteResourceFailedException
     */
    public function run(Setting $setting)
    {
        try {
            return App::make(SettingRepository::class)->delete($setting->id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
