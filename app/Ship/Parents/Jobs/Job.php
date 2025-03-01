<?php

namespace App\Ship\Parents\Jobs;

use Apiato\Core\Jobs\Job as AbstractJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

abstract class Job extends AbstractJob implements ShouldQueue
{
    use Queueable;
}
