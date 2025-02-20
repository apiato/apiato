<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\EmailVerificationServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EmailVerificationServiceProvider::class)]
final class EmailVerificationServiceProviderTest extends UnitTestCase
{
    public function testItCustomizesVerificationUrl(): void
    {
        URL::partialMock()
            ->shouldReceive('temporarySignedRoute')
            ->andReturn('http://localhost');
        $url = call_user_func(VerifyEmail::$createUrlCallback, User::factory()->makeOne());

        $this->assertStringContainsString('verification_url=', $url);
    }
}
