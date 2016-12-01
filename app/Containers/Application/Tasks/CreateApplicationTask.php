<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Containers\Application\Models\Application;
use App\Port\Task\Abstracts\Task;

/**
 * Class CreateApplicationTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateApplicationTask extends Task
{

    /**
     * @var  \App\Containers\Application\Data\Repositories\ApplicationRepository
     */
    private $applicationRepository;

    /**
     * CreateApplicationTask constructor.
     *
     * @param \App\Containers\Application\Data\Repositories\ApplicationRepository $applicationRepository
     */
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @param $name
     * @param $userId
     *
     * @return  \App\Containers\Application\Models\Application|mixed
     */
    public function run($name, $userId)
    {
        $application = new Application();
        $application->name = $name;
        $application->user()->associate($userId);
        $application = $this->applicationRepository->create($application->toArray());

        return $application;
    }

}
