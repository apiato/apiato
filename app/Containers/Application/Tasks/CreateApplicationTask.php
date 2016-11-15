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
     * @param $description
     * @param $price
     * @param $weight
     * @param $quantity
     * @param $applicationTypeId
     *
     * @return  \App\Containers\Application\Models\Application|mixed
     */
    public function run($name, $token = null)
    {
        $application = new Application();
        $application->name = $name;

        if ($token) {
            $application->token = $token;
        }

        $application = $this->applicationRepository->create($application->toArray());

        return $application;
    }

}
