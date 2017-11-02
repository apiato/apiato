<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindSettingByIdTask extends Task
{

    private $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
