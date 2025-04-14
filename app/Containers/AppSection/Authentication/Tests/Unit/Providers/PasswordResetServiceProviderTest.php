<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\GenerateUrlAction;
use App\Containers\AppSection\Authentication\Providers\PasswordResetServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Auth\Notifications\ResetPassword;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordResetServiceProvider::class)]
final class PasswordResetServiceProviderTest extends UnitTestCase
{
    public function testItCustomizesResetUrl(): void
    {
        $this->assertInstanceOf(GenerateUrlAction::class, ResetPassword::$createUrlCallback);
    }
}
