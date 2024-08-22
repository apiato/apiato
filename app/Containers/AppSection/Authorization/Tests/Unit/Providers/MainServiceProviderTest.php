<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Providers;

use App\Containers\AppSection\Authorization\Providers\MainServiceProvider;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(MainServiceProvider::class)]
final class MainServiceProviderTest extends UnitTestCase
{
    private MainServiceProvider $provider;

    public function testProviderHasCorrectProviders(): void
    {
        $this->assertSame([], $this->provider->serviceProviders);
    }

    public function testProviderHasCorrectAliases(): void
    {
        $this->assertSame([], $this->provider->aliases);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = app(MainServiceProvider::class, ['app' => app()]);
    }
}
