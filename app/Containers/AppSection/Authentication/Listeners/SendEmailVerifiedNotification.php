<?php

namespace App\Containers\AppSection\Authentication\Listeners;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendEmailVerifiedNotification extends ParentListener implements ShouldQueue
{
    public function __invoke(Verified $event): void
    {
        $event->user->notify(new EmailVerified());
    }
}
