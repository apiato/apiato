<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateVerificationUrlAction;
use App\Containers\AppSection\Authentication\Providers\EmailVerificationServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Auth\Notifications\VerifyEmail;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EmailVerificationServiceProvider::class)]
final class EmailVerificationServiceProviderTest extends UnitTestCase
{
    public function testItCustomizesVerificationUrl(): void
    {
        $this->assertInstanceOf(GenerateVerificationUrlAction::class, VerifyEmail::$createUrlCallback);
    }
}
