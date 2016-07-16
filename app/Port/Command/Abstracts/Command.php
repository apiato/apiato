<?php

namespace App\Port\Commands\Abstracts;

use App\Port\Commands\Traits\DispatcherTrait;
use Illuminate\Foundation\Bus\DispatchesJobs as LaravelDispatchesJobs;

/**
 * Class Command.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Command
{
    use LaravelDispatchesJobs;
    use DispatcherTrait;
}
