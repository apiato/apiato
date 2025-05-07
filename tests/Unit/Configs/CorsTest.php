<?php

namespace Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class CorsTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('cors');
        $expected = [
            'paths' => ['*', 'sanctum/csrf-cookie'],
            'allowed_methods' => ['*'],
            'allowed_origins' => [
                'url' => env('FRONTEND_URL', env('APP_URL', 'http://localhost:3000')),
            ],
            'allowed_origins_patterns' => [],
            'allowed_headers' => ['*'],
            'exposed_headers' => [],
            'max_age' => 0,
            'supports_credentials' => false,
        ];

        $this->assertEqualsCanonicalizing($expected, $config);
    }
}
