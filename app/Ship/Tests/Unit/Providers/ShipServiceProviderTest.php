<?php

namespace App\Ship\Tests\Unit\Providers;

use App\Ship\Providers\ShipServiceProvider;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(ShipServiceProvider::class)]
final class ShipServiceProviderTest extends ShipTestCase
{
    public static function appDataProvider(): array
    {
        return [
            ['web', static fn () => 'web'],
            ['mobile', static fn () => 'mobile'],
            'falls back to default' => [null, static fn () => config('apiato.defaults.app')],
        ];
    }

    #[DataProvider('appDataProvider')]
    public function testItCanReturnAppId(string|null $appId, \Closure $expectation): void
    {
        if ($appId) {
            request()->headers->set('App-Identifier', $appId);
        }
        config(['apiato.apps' => [
            'web' => null,
            'desktop' => null,
            'mobile' => null,
        ]]);

        $result = request()->appId();

        $this->assertEquals($result, $expectation());
    }
}
