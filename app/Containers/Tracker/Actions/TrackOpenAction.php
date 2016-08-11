<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\Tracker\Services\FindTimeTrackerService;
use App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;
use Carbon\Carbon;

/**
 * Class TrackOpenAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class TrackOpenAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * @var  \App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * @var  \App\Containers\Tracker\Services\FindTimeTrackerService
     */
    private $findTimeTrackerService;

    /**
     * TrackOpenAction constructor.
     *
     * @param \App\Containers\User\Services\FindUserService                       $findUserService
     * @param \App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(
        FindUserService $findUserService,
        TimeTrackerRepository $timeTrackerRepository,
        FindTimeTrackerService $findTimeTrackerService
    ) {
        $this->findUserService = $findUserService;
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->findTimeTrackerService = $findTimeTrackerService;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($visitorId)
    {
        $user = $this->findUserService->byVisitorId($visitorId);

        // check if any previous session was not closed
        $timeTracker = $this->findTimeTrackerService->byUserIdAndStatusPending($user->id);
        if ($timeTracker && $timeTracker->status == TimeTracker::PENDING) {
            $this->timeTrackerRepository->update(['status' => TimeTracker::FAILED], $timeTracker->id);
        }

        // create the new record with pending status
        $timeTracker = new TimeTracker();
        $timeTracker->open_at = Carbon::now();
        $timeTracker->status = TimeTracker::PENDING;
        $timeTracker->user()->associate($user);
        $timeTracker = $this->timeTrackerRepository->create($timeTracker->toArray());

        return $timeTracker;
    }
}
