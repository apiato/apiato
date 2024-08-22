<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Configs;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
final class AuthenticationConfigTest extends UnitTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $this->assertIsArray(config('appSection-authentication'));
        $this->assertArrayHasKey('require_email_verification', config('appSection-authentication'));
        $this->assertFalse(config('appSection-authentication.require_email_verification'));
        $this->assertArrayHasKey('email_verification_link_expiration_time_in_minute', config('appSection-authentication'));
        $this->assertEquals(30, config('appSection-authentication.email_verification_link_expiration_time_in_minute'));
        $this->assertArrayHasKey('clients', config('appSection-authentication'));
        $this->assertArrayHasKey('web', config('appSection-authentication.clients'));
        $this->assertArrayHasKey('id', config('appSection-authentication.clients.web'));
        $this->assertArrayHasKey('secret', config('appSection-authentication.clients.web'));
        $this->assertArrayHasKey('mobile', config('appSection-authentication.clients'));
        $this->assertArrayHasKey('id', config('appSection-authentication.clients.mobile'));
        $this->assertArrayHasKey('secret', config('appSection-authentication.clients.mobile'));
        $this->assertArrayHasKey('login', config('appSection-authentication'));
        $this->assertArrayHasKey('fields', config('appSection-authentication.login'));
        $this->assertArrayHasKey('email', config('appSection-authentication.login.fields'));
        $this->assertSame(['email'], config('appSection-authentication.login.fields.email'));
        $this->assertArrayHasKey('case_sensitive', config('appSection-authentication.login'));
        $this->assertFalse(config('appSection-authentication.login.case_sensitive'));
        $this->assertArrayHasKey('prefix', config('appSection-authentication.login'));
        $this->assertEmpty(config('appSection-authentication.login.prefix'));
        $this->assertArrayHasKey('allowed-reset-password-urls', config('appSection-authentication'));
        $this->assertSame([
            env('APP_URL', 'http://api.apiato.test/v1') . '/password/reset',
        ], config('appSection-authentication.allowed-reset-password-urls'));
        $this->assertArrayHasKey('allowed-verify-email-urls', config('appSection-authentication'));
        $this->assertSame([
            env('APP_URL', 'http://api.apiato.test/v1') . '/email/verify',
        ], config('appSection-authentication.allowed-verify-email-urls'));
    }
}
