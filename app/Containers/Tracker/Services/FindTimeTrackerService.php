<?php

namespace App\Containers\Tracker\Services;


use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository;
use App\Port\Criterias\Eloquent\IsNullCriteria;
use App\Port\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Port\Service\Abstracts\Service;

/**
 * Class FindTimeTrackerService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindTimeTrackerService extends Service
{

    /**
     * @var  \App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * FindTimeTrackerService constructor.
     *
     * @param \App\Containers\Tracker\Settings\Repositories\TimeTrackerRepository $timeTrackerRepository
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function byId($id)
    {
        return $this->timeTrackerRepository->find($id);
    }

    /**
     * @param $userId
     *
     * @return  mixed
     */
    public function byUserId($userId)
    {
        return $this->timeTrackerRepository->findByField('user_id', $userId)->first();
    }

    /**
     * @param $userId
     *
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function byUserIdAndStatusNull($userId)
    {
        $this->timeTrackerRepository->pushCriteria(new IsNullCriteria('status'));

        return $this->byUserId($userId);
    }


    /**
     * @param $userId
     *
     * @return  mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function byUserIdAndStatusPending($userId)
    {
        $this->timeTrackerRepository->pushCriteria(new ThisEqualThatCriteria('status', TimeTracker::PENDING));

        return $this->byUserId($userId);
    }
}
