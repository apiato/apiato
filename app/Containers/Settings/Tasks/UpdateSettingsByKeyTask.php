<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UpdateSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingsByKeyTask extends Task
{
    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * UpdateSettingsByKeyTask constructor.
     * @param SettingRepository $repository
     */
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
     */
    public function run($key, $value)
    {
        $setting = $this->repository->findWhere(['key' => $key])->first();

        if(! $setting) {
            throw new SettingNotFoundException();
        }

        return $this->repository->update([
            'value' => $value
        ], $setting->id);
    }

}
