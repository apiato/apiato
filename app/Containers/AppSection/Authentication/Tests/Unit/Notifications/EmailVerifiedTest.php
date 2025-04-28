<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EmailVerified::class)]
final class EmailVerifiedTest extends UnitTestCase
{
    public function testCanSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $model = UserFactory::new()->createOne();

        $model->notify(new EmailVerified());

        Notification::assertSentTo($model, EmailVerified::class, function (EmailVerified $notification) use ($model): true {
            $mailMessage = $notification->toMail($model);
            $this->assertSame('Email Verified', $mailMessage->subject);
            $this->assertSame(['Your email has been verified.'], $mailMessage->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
