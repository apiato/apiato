<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

class UpdateSettingTask extends Task
{

    /**
     * @param $id
     * @param $data
     *
     * @return Setting
     * @throws UpdateResourceFailedException
     */
    public function run($id, $data): Setting
    {
        try {
            return App::make(SettingRepository::class)->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
