<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordReset::class)]
final class PasswordResetTest extends UnitTestCase
{
    public function testSendMail(): void
    {
        $notification = new PasswordReset();
        $user = User::factory()->make();

        $result = $notification->toMail($user);

        $this->assertSame('Password Reset', $result->subject);
        $this->assertSame(['Your password has been reset successfully.'], $result->introLines);
    }
}
