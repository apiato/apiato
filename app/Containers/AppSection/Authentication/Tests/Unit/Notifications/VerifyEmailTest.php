<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(VerifyEmail::class)]
final class VerifyEmailTest extends UnitTestCase
{
    protected string $subject = 'Verify Email Address';
    protected array $lines = [
        'Please click the below button to verify your email address.',
        'If you did not create an account, no further action is required.',
    ];
    protected string $action = 'Verify Email Address';

    public function testSendMail(): void
    {
        $verificationUrl = 'https://verfly.world';

        Notification::fake();
        Notification::assertNothingSent();

        $user = UserFactory::new()->createOne();
        $user->notify(new VerifyEmail($verificationUrl));

        Notification::assertSentTo($user, VerifyEmail::class, function (VerifyEmail $notification) use ($user) {
            $mailData = $notification->toMail($user)->toArray();

            foreach ($this->lines as $line) {
                $this->assertContains($line, array_merge($mailData['introLines'], $mailData['outroLines']));
            }
            $this->assertSame($this->action, $mailData['actionText']);

            return $this->subject === $mailData['subject'];
        });

        Notification::assertCount(1);
    }
}
