<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(Welcome::class)]
final class WelcomeTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        $verificationUrl = 'https://verfly.world';

        Notification::fake();
        Notification::assertNothingSent();

        $user = UserFactory::new()->createOne();
        $user->notify(new Welcome($verificationUrl));

        Notification::assertSentTo($user, Welcome::class, function (Welcome $notification) use ($user) {
            $mailData = $notification->toMail($user)->toArray();

            $this->assertContains('Thank you for registering ' . $user->name, $mailData['introLines']);

            return 'Welcome to ' . config('app.name') === $mailData['subject'];
        });

        Notification::assertCount(1);
    }
}
