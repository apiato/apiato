<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordReset::class)]
final class PasswordResetTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $model = UserFactory::new()->createOne();

        $model->notify(new PasswordReset());

        Notification::assertSentTo($model, PasswordReset::class, function (PasswordReset $notification) use ($model): true {
            $mailMessage = $notification->toMail($model);
            $this->assertSame('Password Reset', $mailMessage->subject);
            $this->assertSame(['Your password has been reset successfully.'], $mailMessage->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
