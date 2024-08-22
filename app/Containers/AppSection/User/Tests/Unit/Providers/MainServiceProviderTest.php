<?php

namespace App\Containers\AppSection\User\Tests\Unit\Providers;

use App\Containers\AppSection\User\Providers\MainServiceProvider;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
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

    public function testProviderSetsDefaultPasswordRules(): void
    {
        $this->assertEquals(
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
            Password::defaults(),
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = app(MainServiceProvider::class, ['app' => app()]);
    }
}
