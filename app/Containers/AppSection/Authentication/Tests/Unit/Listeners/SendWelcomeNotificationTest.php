<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Listeners;

use App\Containers\AppSection\Authentication\Listeners\SendWelcomeNotification;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendWelcomeNotification::class)]
final class SendWelcomeNotificationTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Event::fake();
        Notification::fake();
        $listener = new SendWelcomeNotification();
        $event = new Registered($user = User::factory()->makeOne());

        $listener($event);

        Notification::assertSentTo($user, Welcome::class);
        Event::assertListening(Registered::class, SendWelcomeNotification::class);
    }
}
