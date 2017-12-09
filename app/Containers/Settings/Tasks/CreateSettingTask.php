<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

class CreateSettingTask extends Task
{

    /**
     * @param array $data
     *
     * @return Setting
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Setting
    {
        try {
            return App::make(SettingRepository::class)->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
