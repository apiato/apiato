<?php

namespace App\Containers\Tracker\Data\Repositories;

use App\Containers\Tracker\Models\TimeTracker;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class TimeTrackerRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class TimeTrackerRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return TimeTracker::class;
    }
}
