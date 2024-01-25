<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(PasswordReset::class)]
final class PasswordResetTest extends UnitTestCase
{
    protected string $subject = 'Password Reset';
    protected string $line = 'Your password has been reset successfully.';
    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();

        $user = UserFactory::new()->createOne();
        $user->notify(new PasswordReset());

        Notification::assertSentTo($user, PasswordReset::class, function (PasswordReset $notification) use ($user) {
            $mailData = $notification->toMail($user)->toArray();

            $this->assertContains($this->line, $mailData['introLines']);

            return $this->subject === $mailData['subject'];
        });

        Notification::assertCount(1);
    }
}
