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
    protected string $subject = 'Email Verified';
    protected string $line = 'Your email has been verified.';

    public function testSendMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();

        $user = UserFactory::new()->createOne();
        $user->notify(new EmailVerified());

        Notification::assertSentTo($user, EmailVerified::class, function (EmailVerified $notification) use ($user) {
            $mailData = $notification->toMail($user)->toArray();

            $this->assertContains($this->line, $mailData['introLines']);

            return $this->subject === $mailData['subject'];
        });

        Notification::assertCount(1);
    }
}
