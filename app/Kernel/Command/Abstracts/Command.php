<?php

namespace App\Kernel\Commands\Abstracts;

use App\Kernel\Commands\Traits\DispatcherTrait;
use Illuminate\Contracts\Bus\SelfHandling as LaravelSelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs as LaravelDispatchesJobs;

/**
 * Class Command.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Command implements LaravelSelfHandling
{

    use LaravelDispatchesJobs;
    use DispatcherTrait;
}
