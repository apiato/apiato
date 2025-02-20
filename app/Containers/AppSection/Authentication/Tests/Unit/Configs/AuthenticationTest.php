<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Configs;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class AuthenticationTest extends UnitTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('appSection-authentication');
        $expected = [
            'clients' => [
                'web' => [
                    'id' => env('CLIENT_WEB_ID'),
                    'secret' => env('CLIENT_WEB_SECRET'),
                ],
                'mobile' => [
                    'id' => env('CLIENT_MOBILE_ID'),
                    'secret' => env('CLIENT_MOBILE_SECRET'),
                ],
            ],
            'login' => [
                'fields' => [
                    'email' => ['email'],
                ],
                'prefix' => '',
            ],
            'allowed-reset-password-urls' => [
                env('FRONTEND_URL', 'http://localhost:3000') . '/password/reset',
            ],
        ];

        $this->assertEquals($expected, $config);
    }
}
