<?php

namespace App\Containers\User\Events\Handlers;

use App\Containers\Email\Mails\WelcomeEmail;
use App\Containers\User\Events\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserCreatedEventHandler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserCreatedEventHandler implements ShouldQueue
{

    /**
     * @param \App\Containers\User\Events\Events\UserCreatedEvent $event
     */
    public function handle(UserCreatedEvent $event)
    {
        $email = new WelcomeEmail();
        $email->setEmail($event->user->email);
        $email->setName($event->user->name);
        $email->send([
            'name'    => $event->user->name,
            'appName' => 'Hello API'
        ]);

    }
}
