<?php

namespace App\Containers\Tracker\Tasks;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class ListTimeTrackersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListTimeTrackersTask extends Task
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
    public function run($relations = ['user'])
    {
        $this->timeTrackerRepository->with($relations);

        return $this->timeTrackerRepository->paginate();
    }


}
