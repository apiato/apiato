<?php

namespace App\Ship\Parents\Jobs;

use Apiato\Core\Abstracts\Jobs\Job as AbstractJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class Job
 *
 * A.K.A (app/Jobs/Job.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Job extends AbstractJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

}
