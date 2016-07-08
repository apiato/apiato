<?php

namespace App\Port\Job\Abstracts;

use Illuminate\Bus\Queueable;

/**
 * Class Job
 *
 * A.K.A (app/Jobs/Job.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;
}
