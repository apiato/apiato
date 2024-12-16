<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Middlewares;

use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Ship\Enums\AuthGuard;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;

#[CoversClass(RedirectIfAuthenticated::class)]
final class RedirectIfAuthenticatedTest extends UnitTestCase
{
    public static function validGuardCombinationDataProvider(): array
    {
        return [
            [
                AuthGuard::API->value,
                AuthGuard::API->value,
            ],
            [
                AuthGuard::WEB->value,
                AuthGuard::WEB->value,
            ],
            [
                AuthGuard::API->value,
                null,
            ],
            [
                AuthGuard::API->value,
                '',
            ],
            [
                AuthGuard::WEB->value,
                null,
            ],
            [
                AuthGuard::WEB->value,
                '',
            ],
        ];
    }

    public static function nonMatchingGuardDataProvider(): array
    {
        return [
            [
                AuthGuard::API->value,
                AuthGuard::WEB->value,
            ],
            [
                AuthGuard::WEB->value,
                AuthGuard::API->value,
            ],
        ];
    }

    #[TestDox('redirects if logged in with same guard or no guard (guessing guard)')]
    #[DataProvider('validGuardCombinationDataProvider')]
    public function testRedirectsIfAuthenticated(string $authenticatedGuard, string|null $requestGuard): void
    {
        $user = UserFactory::new()->makeOne();
        $this->actingAs($user, $authenticatedGuard);
        $request = Request::create(route('login'));
        $middleware = new RedirectIfAuthenticated();

        $response = $middleware->handle($request, static fn (Request $req) => $req, $requestGuard);

        $this->assertTrue($response->isRedirect(action(HomePageController::class)));
    }

    #[TestDox('dont redirect if logged in with different guard (means not logged in)')]
    #[DataProvider('nonMatchingGuardDataProvider')]
    public function testDontRedirectIfNonMatchingGuardProvided(string $authenticatedGuard, string|null $requestGuard): void
    {
        $user = UserFactory::new()->makeOne();
        $this->actingAs($user, $authenticatedGuard);
        $request = Request::create(route('login'));
        $middleware = new RedirectIfAuthenticated();

        $middleware->handle($request, function (Request $req) {
            $this->assertInstanceOf(Request::class, $req);
        }, $requestGuard);
    }

    public function testDontRedirectIfUnauthenticated(): void
    {
        $request = Request::create(route('login'));
        $middleware = new RedirectIfAuthenticated();

        $middleware->handle($request, function (Request $req) {
            $this->assertInstanceOf(Request::class, $req);
        });
    }
}
