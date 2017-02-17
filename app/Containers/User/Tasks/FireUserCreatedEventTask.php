<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Ship\Action\Abstracts\Action;
use App\Ship\Event\Dispatcher\EventsDispatcher;

/**
 * Class FireUserCreatedEventTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FireUserCreatedEventTask extends Action
{

    /**
     * @var  \App\Ship\Event\Dispatcher\EventsDispatcher
     */
    private $eventsDispatcher;

    /**
     * FireUserCreatedEventTask constructor.
     *
     * @param \App\Ship\Event\Dispatcher\EventsDispatcher $eventsDispatcher
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
        // Dispatch a User Created Event
        $this->eventsDispatcher->dispatch(New UserCreatedEvent($user));

        return $user;
    }
}
