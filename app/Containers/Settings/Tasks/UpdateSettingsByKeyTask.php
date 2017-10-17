<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class UpdateSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingsByKeyTask extends Task
{

    private $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     * @throws SettingNotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run($key, $value)
    {
        $setting = $this->repository->findWhere(['key' => $key])->first();

        if (!$setting) {
            throw new SettingNotFoundException();
        }

        try {
            return $this->repository->update([
                'value' => $value
            ], $setting->id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

}
