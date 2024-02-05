<?php

namespace App\Containers\AppSection\User\Tests\Unit\Notifications;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(PasswordUpdatedNotification::class)]
final class PasswordUpdatedNotificationTest extends UnitTestCase
{
    public function testCanSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $user = UserFactory::new()->createOne();

        $user->notify(new PasswordUpdatedNotification());

        Notification::assertSentTo($user, PasswordUpdatedNotification::class, function (PasswordUpdatedNotification $notification) use ($user) {
            $email = $notification->toMail($user);
            $this->assertSame('Account Change Notice', $email->subject);
            $this->assertSame([
                'We wanted to let you know that some information was changed for your account:',
                'Your password has been change.',
                'If you recently made account changes, please disregard this message. However, if you did NOT make any changes to your account, we recommend you change your password and make appropriate corrections as soon as possible to ensure account security.',
            ], $email->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
