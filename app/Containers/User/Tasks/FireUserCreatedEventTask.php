<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Ship\Parents\Actions\Action;
use Illuminate\Events\Dispatcher as EventsDispatcher;

/**
 * Class FireUserCreatedEventTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FireUserCreatedEventTask extends Action
{

    /**
     * @var  \Illuminate\Events\Dispatcher
     */
    private $eventsDispatcher;

    /**
     * FireUserCreatedEventTask constructor.
     *
     * @param \Illuminate\Events\Dispatcher $eventsDispatcher
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
