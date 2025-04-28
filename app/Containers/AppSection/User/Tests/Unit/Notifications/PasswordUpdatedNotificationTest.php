<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Notifications;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordUpdatedNotification::class)]
final class PasswordUpdatedNotificationTest extends UnitTestCase
{
    public function testCanSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $model = UserFactory::new()->createOne();

        $model->notify(new PasswordUpdatedNotification());

        Notification::assertSentTo($model, PasswordUpdatedNotification::class, function (PasswordUpdatedNotification $notification) use ($model): true {
            $mailMessage = $notification->toMail($model);
            $this->assertSame('Account Change Notice', $mailMessage->subject);
            $this->assertSame([
                'We wanted to let you know that some information was changed for your account:',
                'Your password has been change.',
                'If you recently made account changes, please disregard this message. However, if you did NOT make any changes to your account, we recommend you change your password and make appropriate corrections as soon as possible to ensure account security.',
            ], $mailMessage->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
