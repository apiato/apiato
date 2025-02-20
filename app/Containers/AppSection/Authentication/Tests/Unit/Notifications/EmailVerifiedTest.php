<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Notifications;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EmailVerified::class)]
final class EmailVerifiedTest extends UnitTestCase
{
    public function testCanSendMail(): void
    {
        $notification = new EmailVerified();
        $user = User::factory()->make();

        $result = $notification->toMail($user);

        $this->assertSame('Email Verified', $result->subject);
        $this->assertSame(['Your email has been verified.'], $result->introLines);
    }
}
