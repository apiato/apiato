<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(Welcome::class)]
final class WelcomeTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $user = UserFactory::new()->createOne();

        $user->notify(new Welcome());

        Notification::assertSentTo($user, Welcome::class, function (Welcome $notification) use ($user) {
            $email = $notification->toMail($user);
            $this->assertSame('Welcome to ' . config('app.name'), $email->subject);
            $this->assertSame(['Thank you for registering ' . $user->name], $email->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
