<?php

namespace App\Containers\Tracker\Tasks;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\Tracker\Models\TimeTracker;
use App\Port\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindPendingTimeTrackerByUserIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPendingTimeTrackerByUserIdTask extends Task
{

    /**
     * @var  \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * FindTimeTrackerTask constructor.
     *
     * @param \App\Containers\Tracker\Data\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
    }

    /**
     * @param $userId
     *
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function run($userId)
    {
        $this->timeTrackerRepository->pushCriteria(new ThisEqualThatCriteria('status', TimeTracker::PENDING));

        return $this->timeTrackerRepository->findByField('user_id', $userId)->first();
    }
}
