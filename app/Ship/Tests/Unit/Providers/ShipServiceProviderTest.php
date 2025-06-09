<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Providers;

use App\Ship\Providers\ShipServiceProvider;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(ShipServiceProvider::class)]
final class ShipServiceProviderTest extends ShipTestCase
{
    public static function appDataProvider(): \Iterator
    {
        yield ['web', static fn (): string => 'web'];
        yield ['mobile', static fn (): string => 'mobile'];
        yield 'falls back to default' => [null, static fn () => config('apiato.defaults.app')];
    }

    #[DataProvider('appDataProvider')]
    public function testItCanReturnAppId(null|string $appId, \Closure $expectation): void
    {
        if ($appId !== null && $appId !== '' && $appId !== '0') {
            request()->headers->set('App-Identifier', $appId);
        }

        config(['apiato.apps' => [
            'web'     => null,
            'desktop' => null,
            'mobile'  => null,
        ],
        ]);

        $result = request()->appId();

        self::assertEquals($result, $expectation());
    }
}
