<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Data\Repositories\TimeTrackerRepository;
use App\Containers\User\Tasks\FindUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListTimeTrackerAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListTimeTrackerAction extends Action
{


    /**
     * @var  \App\Containers\Tracker\Actions\TimeTrackerRepository
     */
    private $timeTrackerRepository;

    /**
     * @var  \App\Containers\User\Tasks\FindUserTask
     */
    private $findUserTask;

    /**
     * ListTimeTrackerAction constructor.
     *
     * @param \App\Containers\Tracker\Actions\TimeTrackerRepository $timeTrackerRepository
     * @param \App\Containers\User\Tasks\FindUserTask         $findUserTask
     */
    public function __construct(TimeTrackerRepository $timeTrackerRepository, FindUserTask $findUserTask)
    {
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->findUserTask = $findUserTask;
    }

    /**
     * @param array $relations
     *
     * @return  mixed
     */
    public function all($relations = ['user'])
    {
        $this->timeTrackerRepository->with($relations);

        return $this->timeTrackerRepository->paginate();
    }


}
