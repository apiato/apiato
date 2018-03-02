<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingByKeyTask extends Task
{

    protected $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function run($key)
    {
        $result = $this->repository->findWhere(['key' => $key])->first();

        if (! $result) {
            throw new NotFoundException();
        }

        return $result->value;
    }
}
