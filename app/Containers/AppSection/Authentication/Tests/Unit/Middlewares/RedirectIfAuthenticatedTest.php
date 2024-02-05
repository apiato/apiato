<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Middlewares;

use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Ship\Enums\AuthGuard;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;

#[Group('authentication')]
#[CoversClass(RedirectIfAuthenticated::class)]
final class RedirectIfAuthenticatedTest extends UnitTestCase
{
    public static function validGuardCombinationDataProvider(): array
    {
        return [
            [
                'authenticated_guard' => AuthGuard::API->value,
                'request_guard' => AuthGuard::API->value,
            ],
            [
                'authenticated_guard' => AuthGuard::WEB->value,
                'request_guard' => AuthGuard::WEB->value,
            ],
            [
                'authenticated_guard' => AuthGuard::API->value,
                'request_guard' => null,
            ],
            [
                'authenticated_guard' => AuthGuard::API->value,
                'request_guard' => '',
            ],
            [
                'authenticated_guard' => AuthGuard::WEB->value,
                'request_guard' => null,
            ],
            [
                'authenticated_guard' => AuthGuard::WEB->value,
                'request_guard' => '',
            ],
        ];
    }

    public static function nonMatchingGuardDataProvider(): array
    {
        return [
            [
                'authenticated_guard' => AuthGuard::API->value,
                'request_guard' => AuthGuard::WEB->value,
            ],
            [
                'authenticated_guard' => AuthGuard::WEB->value,
                'request_guard' => AuthGuard::API->value,
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

        $this->assertTrue($response->isRedirect(route('home-page')));
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
