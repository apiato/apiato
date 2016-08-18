<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask;
use App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Task\Abstracts\Task;

/**
 * Class CloseTimeTrackAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CloseTimeTrackAction extends Task
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask
     */
    private $findPendingTimeTrackerByUserIdTask;

    /**
     * @var  \App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask
     */
    private $updateTimeTrackerToCloseTask;

    /**
     * CloseTimeTrackAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask               $findUserByVisitorIdTask
     * @param \App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask $findPendingTimeTrackerByUserIdTask
     * @param \App\Containers\Tracker\Tasks\UpdateTimeTrackerToCloseTask       $updateTimeTrackerToCloseTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        FindPendingTimeTrackerByUserIdTask $findPendingTimeTrackerByUserIdTask,
        UpdateTimeTrackerToCloseTask $updateTimeTrackerToCloseTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
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
        // find the user by visitor ID to get his real ID
        $user = $this->findUserByVisitorIdTask->run($visitorId);

        // find the pending to close track for this user
        $timeTracker = $this->findPendingTimeTrackerByUserIdTask->run($user->id);

        // update the record with the closing data
        $this->updateTimeTrackerToCloseTask->run($timeTracker);

        return $timeTracker;
    }
}
