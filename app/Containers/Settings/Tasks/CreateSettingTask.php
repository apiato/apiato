<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Parents\Tasks\Task;

class CreateSettingTask extends Task
{
    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * CreateSettingTask constructor.
     *
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function run(array $data)
    {
        return $this->repository->create($data);
    }
}
