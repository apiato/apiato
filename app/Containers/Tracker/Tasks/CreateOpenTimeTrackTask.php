<?php

namespace App\Containers\Tracker\Tasks;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Task\Abstracts\Task;
use Carbon\Carbon;

/**
 * Class CreateOpenTimeTrackTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateOpenTimeTrackTask extends Task
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
     * @param \App\Containers\User\Models\User $user
     *
     * @return  \App\Containers\Tracker\Models\TimeTracker|mixed
     */
    public function run(User $user)
    {

        // create the new record with pending status
        $timeTracker = new TimeTracker();
        $timeTracker->open_at = Carbon::now();
        $timeTracker->status = TimeTracker::PENDING;
        $timeTracker->user()->associate($user);
        $timeTracker = $this->timeTrackerRepository->create($timeTracker->toArray());

        return $timeTracker;
    }
}
