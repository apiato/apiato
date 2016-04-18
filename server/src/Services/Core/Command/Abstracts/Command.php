<?php

namespace Mega\Services\Core\Command\Abstracts;

use Illuminate\Contracts\Bus\SelfHandling as LaravelSelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs as LaravelDispatchesJobs;
use Mega\Services\Core\Command\Traits\DispatcherTrait;

/**
 * Class Command
 *
 * @type    Abstract
 * @package Mega\Services\Core\Command\Abstracts
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Command implements LaravelSelfHandling
{

    use LaravelDispatchesJobs;
    use DispatcherTrait;
}
