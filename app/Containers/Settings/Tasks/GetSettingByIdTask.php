<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Parents\Tasks\Task;

class GetSettingByIdTask extends Task
{

    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * GetSettingByIdTask constructor.
     *
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        $setting = $this->repository->find($id);

        if(!$setting) {
            throw new SettingNotFoundException();
        }

        return $setting;
    }
}
