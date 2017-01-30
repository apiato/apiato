<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Port\Task\Abstracts\Task;
use App\Port\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Port\Criterias\Eloquent\ThisUserCriteria;

/**
 * Class ListAllAppsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllAppsTask extends Task
{
    /**
     * @var \App\Containers\Application\Data\Repositories\ApplicationRepository
     */
    private $applicationRepository;

    /**
     * ListAllAppsTask constructor.
     *
     * @param \App\Containers\Application\Data\Repositories\ApplicationRepository $applicationRepository
     */
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        $this->applicationRepository->pushCriteria(new ThisUserCriteria());

        $this->applicationRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        return $this->applicationRepository->all();
    }

}
