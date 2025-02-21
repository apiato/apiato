<?php

namespace App\Containers\AppSection\Authentication\Listeners;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendWelcomeNotification extends ParentListener implements ShouldQueue
{
    public function __invoke(Registered $event): void
    {
        $event->user->notify(new Welcome());
    }
}
