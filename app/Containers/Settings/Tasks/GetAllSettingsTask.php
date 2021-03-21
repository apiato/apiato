<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Criterias\OrderByKeyAscendingCriteria;
use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllSettingsTask extends Task
{
    protected SettingRepository $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function ordered(): SettingRepository
    {
        return $this->repository->pushCriteria(new OrderByKeyAscendingCriteria());
    }
}
