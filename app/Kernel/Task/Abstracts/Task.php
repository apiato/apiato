<?php

namespace App\Kernel\Task\Abstracts;

use Illuminate\Events\Dispatcher;

/**
 * Class Task.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Task
{

    /**
     * @var  \Illuminate\Events\Dispatcher
     */
    public $eventsDispatcher;

    /**
     * Task constructor.
     *
     * @param \Illuminate\Events\Dispatcher $eventsDispatcher
     */
    public function __construct(Dispatcher $eventsDispatcher)
    {
        $this->eventsDispatcher = $eventsDispatcher;
    }

}
