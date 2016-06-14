<?php

namespace Hello\Modules\Core\CommandsDispatcher\Abstracts;

use Hello\Modules\Core\CommandsDispatcher\Traits\DispatcherTrait;
use Illuminate\Contracts\Bus\SelfHandling as LaravelSelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs as LaravelDispatchesJobs;

/**
 * Class CommandsDispatcher.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class CommandsDispatcher implements LaravelSelfHandling
{

    use LaravelDispatchesJobs;
    use DispatcherTrait;
}
