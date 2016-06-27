<?php

namespace App\Containers\User\Events\Handlers;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Services\Mails\Mails\WelcomeEmail;
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
     * @param \App\Containers\User\Events\Events\UserCreatedEvent $event
     */
    public function handle(UserCreatedEvent $event)
    {
        dump('New User Created Successfully!');

        $email = new WelcomeEmail();
        $email->setEmail('testing@tester.com');
        $email->setName('Mahmoud Zalt');
        $email->send($data = []);

    }
}
