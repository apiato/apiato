<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class FindSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingByKeyTask extends Task
{

    /**
     * @param $key
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function run($key)
    {
        $result = App::make(SettingRepository::class)->findWhere(['key' => $key])->first();

        if (!$result) {
            throw new NotFoundException();
        }

        return $result->value;
    }
}
