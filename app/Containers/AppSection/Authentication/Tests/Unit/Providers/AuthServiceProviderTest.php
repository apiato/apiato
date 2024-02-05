<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\AuthServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(AuthServiceProvider::class)]
final class AuthServiceProviderTest extends UnitTestCase
{
    private AuthServiceProvider $provider;

    public function testProviderHasCorrectFields(): void
    {
        $this->assertTrue($this->provider->isDeferred());
        $this->assertSame([], $this->provider->policies());
    }

    public function testCanConfigurePassport(): void
    {
        $this->assertTrue(Passport::$implicitGrantEnabled);
        $this->assertSame(59, Passport::$tokensExpireIn->i);
        $this->assertSame(59, Passport::$refreshTokensExpireIn->i);
    }

    public function testRegistersPassportApiRoutes(): void
    {
        $registeredRoutes = Route::getRoutes();
        $registeredRoutes->refreshNameLookups();
        $passportRouteNames = [
            'passport.token',
            'passport.tokens.index',
            'passport.tokens.destroy',

            'passport.token.refresh',

            'passport.clients.index',
            'passport.clients.store',
            'passport.clients.update',
            'passport.clients.destroy',

            'passport.scopes.index',
            'passport.personal.tokens.index',
            'passport.personal.tokens.store',
            'passport.personal.tokens.destroy',
        ];

        $apiPrefix = $this->removeLeadingSlashes(config('apiato.api.prefix'));
        $oAuthPrefix = $apiPrefix . 'v1/oauth';
        foreach ($passportRouteNames as $routeName) {
            $this->assertNotNull($registeredRoutes->getByName($routeName));
            $this->assertSamePrefix($oAuthPrefix, $registeredRoutes->getByName($routeName)->getPrefix());
        }
    }

    private function removeLeadingSlashes(string $value): string
    {
        return ltrim($value, '/');
    }

    private function assertSamePrefix(string $prefix, string $endpoint): void
    {
        $this->assertSame(
            $prefix,
            $endpoint,
            'The prefix of the route does not match the expected value.',
        );
    }

    public function testDoesntRegisterPassportWebRoutes(): void
    {
        $registeredRoutes = Route::getRoutes();
        $registeredRoutes->refreshNameLookups();
        $passportRouteNames = [
            'passport.authorizations.authorize',
            'passport.authorizations.approve',
            'passport.authorizations.deny',
        ];

        foreach ($passportRouteNames as $routeName) {
            $this->assertNull($registeredRoutes->getByName($routeName));
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->provider = app(AuthServiceProvider::class, ['app' => app()]);
    }
}
