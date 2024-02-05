<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Seeders\SeedDeploymentData;
use App\Ship\Seeders\SeedTestingData;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class ApiatoConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('apiato');
        $expected = [
            'hash-id' => env('HASH_ID', true),
            'api' => [
                'url' => env('API_URL', 'http://localhost'),
                'prefix' => env('API_PREFIX', '/'),
                'enable_version_prefix' => true,
                'expires-in' => env('API_TOKEN_EXPIRES', 1440),
                'refresh-expires-in' => env('API_REFRESH_TOKEN_EXPIRES', 43200),
                'debug' => env('API_DEBUG', true),
                'enabled-implicit-grant' => env('API_ENABLE_IMPLICIT_GRANT', true),
                'throttle' => [
                    'enabled' => env('GLOBAL_API_RATE_LIMIT_ENABLED', true),
                    'attempts' => env('GLOBAL_API_RATE_LIMIT_ATTEMPTS_PER_MIN', '30'),
                    'expires' => env('GLOBAL_API_RATE_LIMIT_EXPIRES_IN_MIN', '1'),
                ],
            ],
            'requests' => [
                'allow-roles-to-access-all-routes' => [
                    env('ADMIN_ROLE', 'admin'),
                ],
                'force-accept-header' => false,
                'force-valid-includes' => true,
                'use-etag' => false,
            ],
            'seeders' => [
                'deployment' => SeedDeploymentData::class,
                'testing' => SeedTestingData::class,
            ],
            'tests' => [
                'user-class' => User::class,
                'user-admin-state' => 'admin',
            ],
        ];

        $this->assertSame($expected, $config);
    }
}
