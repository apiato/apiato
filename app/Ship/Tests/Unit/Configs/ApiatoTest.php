<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Apps\Web;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ApiatoTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('apiato');
        $expected = [
            'defaults' => [
                'app' => 'web',
            ],
            'hash-id' => env('HASH_ID', true),
            'api' => [
                'url' => env('API_URL', 'http://localhost'),
                'rate-limiter' => [
                    'name' => env('GLOBAL_API_RATE_LIMITER_NAME', 'api'),
                    'enabled' => env('GLOBAL_API_RATE_LIMITER_ENABLED', true),
                    'attempts' => env('GLOBAL_API_RATE_LIMITER_ATTEMPTS_PER_MIN', '30'),
                    'expires' => env('GLOBAL_API_RATE_LIMITER_EXPIRES_IN_MIN', '1'),
                ],
            ],
            'apps' => [
                'web' => [
                    'class' => Web::class,
                    'url' => env('FRONTEND_URL', env('APP_URL', 'http://localhost:3000')),
                ],
            ],
            'requests' => [
                'force-accept-header' => false,
                'use-etag' => false,
            ],
        ];

        $this->assertEqualsCanonicalizing($expected, $config);
    }
}
