<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Containers\Application\Models\Application;
use App\Port\Task\Abstracts\Task;

/**
 * Class SetApplicationTokenTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetApplicationTokenTask extends Task
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
     * @param \App\Containers\Application\Models\Application $application
     * @param                                                $token
     *
     * @return  \App\Containers\Application\Models\Application|mixed
     */
    public function run(Application $application, $token)
    {
        $attributes = ['token' => $token];

        $application = $this->applicationRepository->update($attributes, $application->id);

        return $application;
    }

}
