<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(EmailVerified::class)]
final class EmailVerifiedTest extends UnitTestCase
{
    public function testCanSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $user = UserFactory::new()->createOne();

        $user->notify(new EmailVerified());

        Notification::assertSentTo($user, EmailVerified::class, function (EmailVerified $notification) use ($user) {
            $email = $notification->toMail($user);
            $this->assertSame('Email Verified', $email->subject);
            $this->assertSame(['Your email has been verified.'], $email->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
