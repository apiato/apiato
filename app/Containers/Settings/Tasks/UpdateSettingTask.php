<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Tasks\Task;

class UpdateSettingTask extends Task
{

    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * UpdateSettingTask constructor.
     *
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Setting $setting
     * @param $data
     *
     * @return mixed
     */
    public function run(Setting $setting, $data)
    {
        return $this->repository->update($data, $setting->id);
    }
}
