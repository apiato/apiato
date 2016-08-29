<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Port\Action\Abstracts\Action;
use App\Port\Event\Dispatcher\EventsDispatcher;

/**
 * Class FireUserCreatedEventTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FireUserCreatedEventTask extends Action
{

    /**
     * @var  \App\Port\Event\Dispatcher\EventsDispatcher
     */
    private $eventsDispatcher;

    /**
     * FireUserCreatedEventTask constructor.
     *
     * @param \App\Port\Event\Dispatcher\EventsDispatcher $eventsDispatcher
     */
    public function __construct(EventsDispatcher $eventsDispatcher)
    {
        $this->eventsDispatcher = $eventsDispatcher;
    }

    /**
     * @param $user
     *
     * @return  mixed
     */
    public function run($user)
    {
        // Fire a User Created Event
        $this->eventsDispatcher->fire(New UserCreatedEvent($user));

        return $user;
    }
}
