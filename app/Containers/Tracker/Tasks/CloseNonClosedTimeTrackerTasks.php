<?php

namespace App\Containers\Tracker\Tasks;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\Tracker\Models\TimeTracker;
use App\Port\Task\Abstracts\Task;

/**
 * Class CloseNonClosedTimeTrackerTasks.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CloseNonClosedTimeTrackerTasks extends Task
{

    /**
     * @var  \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * CloseNonClosedTimeTrackerTasks constructor.
     *
     * @param \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
    }

    /**
     * @param $timeTracker
     *
     * @return  mixed
     */
    public function run($timeTracker)
    {
        // check if any previous session was not closed
        if ($timeTracker && $timeTracker->status == TimeTracker::PENDING) {
            $this->timeTrackerRepository->update(['status' => TimeTracker::FAILED], $timeTracker->id);
        }

        return $timeTracker;
    }
}
