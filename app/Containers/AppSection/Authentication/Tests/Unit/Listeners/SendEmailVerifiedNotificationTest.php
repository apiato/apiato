<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Listeners;

use App\Containers\AppSection\Authentication\Listeners\SendEmailVerifiedNotification;
use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendEmailVerifiedNotification::class)]
final class SendEmailVerifiedNotificationTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Notification::fake();
        Event::fake();
        $listener = new SendEmailVerifiedNotification();
        $event = new Verified($user = User::factory()->makeOne());

        $listener($event);

        Notification::assertSentTo($user, EmailVerified::class);
        Event::assertListening(Verified::class, SendEmailVerifiedNotification::class);
    }
}
