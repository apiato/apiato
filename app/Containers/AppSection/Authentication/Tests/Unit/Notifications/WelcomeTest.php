<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Welcome::class)]
final class WelcomeTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();
        $model = UserFactory::new()->createOne();

        $model->notify(new Welcome());

        Notification::assertSentTo($model, Welcome::class, function (Welcome $notification) use ($model): true {
            $mailMessage = $notification->toMail($model);
            $this->assertSame('Welcome to ' . config('app.name'), $mailMessage->subject);
            $this->assertSame(['Thank you for registering ' . $model->name], $mailMessage->introLines);

            return true;
        });
        Notification::assertCount(1);
    }
}
