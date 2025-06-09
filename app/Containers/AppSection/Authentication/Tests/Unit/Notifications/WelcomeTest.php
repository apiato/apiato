<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Welcome::class)]
final class WelcomeTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        $welcome = new Welcome();
        $user = User::factory()->make();

        $result = $welcome->toMail($user);

        self::assertSame('Welcome to ' . config('app.name'), $result->subject);
        self::assertSame(['Thank you for registering ' . $user->name], $result->introLines);
    }
}
