<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\RequestServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(RequestServiceProvider::class)]
final class RequestServiceProviderTest extends UnitTestCase
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
