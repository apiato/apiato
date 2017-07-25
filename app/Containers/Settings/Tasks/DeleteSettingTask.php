<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Tasks\Task;

class DeleteSettingTask extends Task
{
    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * DeleteSettingTask constructor.
     *
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Setting $setting
     *
     * @return int
     */
    public function run(Setting $setting)
    {
        return $this->repository->delete($setting->id);
    }
}
