<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
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
     * ListTimeTrackerAction constructor.
     *
     * @param \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
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
