<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\Tracker\Tasks\FindTimeTrackerTask;
use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;
use Carbon\Carbon;

/**
 * Class TrackCloseAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class TrackCloseAction extends Action
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
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask                       $findUserByVisitorIdTask
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
     * @param $visitorId
     *
     * @return  mixed
     */
    public function run($visitorId)
    {
        $user = $this->findUserByVisitorIdTask->run($visitorId);

        // check if any previous session was not closed
        $timeTracker = $this->findTimeTrackerTask->byUserIdAndStatusPending($user->id);
        if ($timeTracker && $timeTracker->status == TimeTracker::PENDING) {

            $now = Carbon::now();

            $durationsSeconds = $now->diffInSeconds($timeTracker->open_at);

            $data = [
                'status'   => TimeTracker::SUCCEEDED,
                'close_at' => $now,
                'duration' => $durationsSeconds,
            ];

            $timeTracker = $this->timeTrackerRepository->update($data, $timeTracker->id);
        }

        return $timeTracker;
    }
}
