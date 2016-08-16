<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListTimeTrackerAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListTimeTrackerAction extends Action
{


    /**
     * @var  \App\Containers\Tracker\Actions\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * ListTimeTrackerAction constructor.
     *
     * @param \App\Containers\Tracker\Actions\TimeTrackerRepository $timeTrackerRepository
     * @param \App\Containers\User\Services\FindUserService         $findUserService
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository, FindUserService $findUserService)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->findUserService = $findUserService;
    }

    /**
     * @param array $relations
     *
     * @return  mixed
     */
    public function all($relations = ['user'])
    {
        $this->timeTrackerRepository->with($relations);

        return $this->timeTrackerRepository->paginate();
    }


}
