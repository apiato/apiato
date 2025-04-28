<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyEmail::class)]
final class VerifyEmailTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $model = UserFactory::new()->createOne();

        $model->notify(new VerifyEmail('https://example.com'));

        Notification::assertSentTo($model, VerifyEmail::class, function (VerifyEmail $notification) use ($model): true {
            $mailMessage = $notification->toMail($model);
            $this->assertSame('Verify Email Address', $mailMessage->subject);
            $this->assertSame([
                'Please click the below button to verify your email address.',
            ], $mailMessage->introLines);
            $this->assertSame([
                'If you did not create an account, no further action is required.',
            ], $mailMessage->outroLines);
            $this->assertSame('Verify Email Address', $mailMessage->actionText);

            return true;
        });
        Notification::assertCount(1);
    }
}
