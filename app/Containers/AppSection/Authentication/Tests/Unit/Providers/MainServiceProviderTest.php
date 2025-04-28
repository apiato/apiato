<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\AuthServiceProvider;
use App\Containers\AppSection\Authentication\Providers\MainServiceProvider;
use App\Containers\AppSection\Authentication\Providers\MiddlewareServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Laravel\Passport\PassportServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MainServiceProvider::class)]
final class MainServiceProviderTest extends UnitTestCase
{
    private MainServiceProvider $provider;

    public function testProviderHasCorrectProviders(): void
    {
        $data = [
            AuthServiceProvider::class,
            MiddlewareServiceProvider::class,
            PassportServiceProvider::class,
        ];

        $this->assertSame($data, $this->provider->serviceProviders);
    }

    public function testProviderHasCorrectAliases(): void
    {
        $this->assertSame([], $this->provider->aliases);
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = app(MainServiceProvider::class, ['app' => app()]);
    }
}
