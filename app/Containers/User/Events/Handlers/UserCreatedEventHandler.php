<?php

namespace App\Containers\User\Events\Handlers;

use App\Containers\User\Events\Events\UserCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserCreatedEventHandler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserCreatedEventHandler implements ShouldQueue
{

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Containers\Demo\Events\Events\DemoEvent $event
     *
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        dump('New User Created Successfully!');
    }
}
