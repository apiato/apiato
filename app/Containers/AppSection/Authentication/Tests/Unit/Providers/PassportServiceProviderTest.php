<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\PassportServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PassportServiceProvider::class)]
final class PassportServiceProviderTest extends UnitTestCase
{
    public function testCanConfigurePassport(): void
    {
        $this->assertSame(59, Passport::$tokensExpireIn->i);
        $this->assertSame(59, Passport::$refreshTokensExpireIn->i);
    }

    public function testRegistersPassportRoutes(): void
    {
        $registeredRoutes = Route::getRoutes();
        $registeredRoutes->refreshNameLookups();
        $passportRouteNames = [
            'passport.token',
            'passport.token.refresh',

            'passport.authorizations.authorize',
            'passport.authorizations.approve',
            'passport.authorizations.deny',

            'passport.device',
            'passport.device.code',
            'passport.device.authorizations.authorize',
            'passport.device.authorizations.approve',
            'passport.device.authorizations.deny',
        ];

        $apiPrefix = $this->removeLeadingSlashes(apiato()->routing()->getApiPrefix());
        $oAuthPrefix = $apiPrefix . 'v1/oauth';
        foreach ($passportRouteNames as $routeName) {
            $this->assertNotNull($registeredRoutes->getByName($routeName));
            $this->assertSamePrefix($oAuthPrefix, $registeredRoutes->getByName($routeName)->getPrefix());
        }
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

    public function testDoesNotRegisterJsonApiRoutes(): void
    {
        $registeredRoutes = Route::getRoutes();
        $registeredRoutes->refreshNameLookups();
        $passportRouteNames = [
            'passport.tokens.index',
            'passport.tokens.destroy',
            'passport.clients.index',
            'passport.clients.store',
            'passport.clients.update',
            'passport.clients.destroy',
            'passport.scopes.index',
            'passport.personal.tokens.index',
            'passport.personal.tokens.store',
            'passport.personal.tokens.destroy',
        ];

        $this->assertFalse(Passport::$registersJsonApiRoutes);
        foreach ($passportRouteNames as $routeName) {
            $this->assertNull($registeredRoutes->getByName($routeName));
        }
    }
}
