<?php

namespace App\Containers\Tracker\Actions;

use App\Containers\Tracker\Tasks\ListTimeTrackersTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListTimeTrackerAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListTimeTrackerAction extends Action
{

    /**
     * @var  \App\Containers\Tracker\Tasks\ListTimeTrackersTask
     */
    private $listTimeTrackerTask;

    /**
     * ListTimeTrackerAction constructor.
     *
     * @param \App\Containers\Tracker\Tasks\ListTimeTrackersTask $listTimeTrackerTask
     */
    public function __construct(ListTimeTrackersTask $listTimeTrackerTask)
    {
        $this->listTimeTrackerTask = $listTimeTrackerTask;
    }

    /**
     * @param $relations
     *
     * @return  mixed
     */
    public function run($relations)
    {
        $timeTrackers = $this->listTimeTrackerTask->run($relations);

        return $timeTrackers;
    }


}
