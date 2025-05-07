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
            ],
            'tokens-expire-in' => env('API_TOKEN_EXPIRES', 1440),
            'refresh-tokens-expire-in' => env('API_REFRESH_TOKEN_EXPIRES', 43200),
        ];

        $this->assertEquals($expected, $config);
    }
}
