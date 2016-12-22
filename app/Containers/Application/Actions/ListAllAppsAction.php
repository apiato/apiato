<?php

namespace App\Containers\Application\Actions;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Port\Criterias\Eloquent\ThisUserCriteria;

/**
 * Class ListAllAppsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllAppsAction extends Action
{

    /**
     * ListAllAppsAction constructor.
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
