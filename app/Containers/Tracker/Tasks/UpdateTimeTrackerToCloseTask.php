<?php

namespace App\Containers\Tracker\Tasks;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;
use Carbon\Carbon;

/**
 * Class UpdateTimeTrackerToCloseTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateTimeTrackerToCloseTask extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * @var  \App\Containers\Tracker\Tasks\FindTimeTrackerTask
     */
    private $findTimeTrackerTask;

    /**
     * TrackOpenAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask              $findUserByVisitorIdTask
     * @param \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        TimeTrackerRepository $timeTrackerRepository,
        FindTimeTrackerTask $findTimeTrackerTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->findTimeTrackerTask = $findTimeTrackerTask;
    }

    /**
     * @param \App\Containers\Tracker\Models\TimeTracker $timeTracker
     *
     * @return  \App\Containers\Tracker\Models\TimeTracker|mixed
     */
    public function run(TimeTracker $timeTracker)
    {
        if ($timeTracker && $timeTracker->status == TimeTracker::PENDING) {

            $now = Carbon::now();

            // get the time between now and when it was opened
            $durationsSeconds = $now->diffInSeconds($timeTracker->open_at);

            $data = [
                'status'   => TimeTracker::SUCCEEDED,
                'close_at' => $now,
                'duration' => $durationsSeconds,
            ];
            $this->timeTrackerRepository->update($data, $timeTracker->id);

            return true;
        }

        return false;
    }
}
