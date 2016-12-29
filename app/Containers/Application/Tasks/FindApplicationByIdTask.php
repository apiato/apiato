<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Containers\Application\Exceptions\ApplicationNotFoundException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class FindApplicationByIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindApplicationByIdTask extends Task
{

    /**
     * @var  \App\Containers\Application\Data\Repositories\ApplicationRepository
     */
    private $applicationRepository;

    /**
     * FindApplicationByIdTask constructor.
     *
     * @param \App\Containers\Application\Data\Repositories\ApplicationRepository $applicationRepository
     */
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @param $applicationId
     *
     * @return  mixed
     * @throws \App\Containers\Application\Exceptions\ApplicationNotFoundException
     */
    public function run($applicationId)
    {
        // find the application by its id
        try {
            $application = $this->applicationRepository->find($applicationId);
        } catch (Exception $e) {
            throw new ApplicationNotFoundException();
        }

        return $application;
    }

}
