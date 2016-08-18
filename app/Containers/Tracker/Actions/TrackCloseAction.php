<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask;
use App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

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
     * @var  \App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask
     */
    private $findPendingTimeTrackerByUserIdTask;

    /**
     * @var  \App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask
     */
    private $updateTimeTrackerToCloseTask;

    /**
     * TrackOpenAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask              $findUserByVisitorIdTask
     * @param \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository $timeTrackerRepository
     * @param \App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask               $findPendingTimeTrackerByUserIdTask
     * @param \App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask                    $updateTimeTrackerToCloseTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        TimeTrackerRepository $timeTrackerRepository,
        FindPendingTimeTrackerByUserIdTask $findPendingTimeTrackerByUserIdTask,
        UpdateTimeTrackerToCloseTask $updateTimeTrackerToCloseTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->findPendingTimeTrackerByUserIdTask = $findPendingTimeTrackerByUserIdTask;
        $this->updateTimeTrackerToCloseTask = $updateTimeTrackerToCloseTask;
    }

    /**
     * @param $visitorId
     *
     * @return  mixed
     */
    public function run($visitorId)
    {
        // find the user vy visitor ID to get his real ID
        $user = $this->findUserByVisitorIdTask->run($visitorId);

        // find the pending to close track for this user
        $timeTracker = $this->findPendingTimeTrackerByUserIdTask->run($user->id);

        // update the record with the closing data
        $this->updateTimeTrackerToCloseTask->run($timeTracker);

        return $timeTracker;
    }
}
