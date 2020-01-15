<?php

namespace Apiato\Core\Abstracts\Events\Traits;

/**
 * Created by PhpStorm.
 * User: Arthur Devious
 */

trait JobProperties
{
    /**
     * If ShouldHandle interface is implemented this variable
     * sets the time to wait before a job is executed
     *
     * @var \DateTimeInterface|\DateInterval|int|null $jobDelay
     */

    public $jobDelay;


    /**
     * If ShouldHandle interface is implemented this variable
     * sets the name of the queue to push the job on
     *
     * @var string $jobQueue
     */

    public $jobQueue;
}