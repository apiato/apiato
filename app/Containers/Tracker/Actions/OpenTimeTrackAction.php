<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Tasks\CloseNonClosedTimeTrackerTasks;
use App\Containers\Tracker\Tasks\CreateOpenTimeTrackTask;
use App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class OpenTimeTrackAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class OpenTimeTrackAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\Tracker\Tasks\CloseNonClosedTimeTrackerTasks
     */
    private $closeNonClosedTimeTrackerTasks;

    /**
     * @var  \App\Containers\Tracker\Actions\CreateOpenTimeTrackTask
     */
    private $createOpenTimeTrackTask;

    /**
     * @var  \App\Containers\Tracker\Actions\FindPendingTimeTrackerByUserIdTask
     */
    private $findPendingTimeTrackerByUserIdTask;

    /**
     * OpenTimeTrackAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask               $findUserByVisitorIdTask
     * @param \App\Containers\Tracker\Tasks\CloseNonClosedTimeTrackerTasks     $closeNonClosedTimeTrackerTasks
     * @param \App\Containers\Tracker\Tasks\CreateOpenTimeTrackTask            $createOpenTimeTrackTask
     * @param \App\Containers\Tracker\Tasks\FindPendingTimeTrackerByUserIdTask $findPendingTimeTrackerByUserIdTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        CloseNonClosedTimeTrackerTasks $closeNonClosedTimeTrackerTasks,
        CreateOpenTimeTrackTask $createOpenTimeTrackTask,
        FindPendingTimeTrackerByUserIdTask $findPendingTimeTrackerByUserIdTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->closeNonClosedTimeTrackerTasks = $closeNonClosedTimeTrackerTasks;
        $this->createOpenTimeTrackTask = $createOpenTimeTrackTask;
        $this->findPendingTimeTrackerByUserIdTask = $findPendingTimeTrackerByUserIdTask;
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

        // close missing time trackers
        $this->closeNonClosedTimeTrackerTasks->run($timeTracker);

        // create new time track record
        $this->createOpenTimeTrackTask->run($user);

        return $timeTracker;
    }
}
