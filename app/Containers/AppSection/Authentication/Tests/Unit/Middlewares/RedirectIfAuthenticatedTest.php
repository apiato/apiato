<?php

declare(strict_types=1);

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
    public static function validGuardCombinationDataProvider(): \Iterator
    {
        yield [
            AuthGuard::API->value,
            AuthGuard::API->value,
        ];
        yield [
            AuthGuard::WEB->value,
            AuthGuard::WEB->value,
        ];
        yield [
            AuthGuard::API->value,
            null,
        ];
        yield [
            AuthGuard::API->value,
            '',
        ];
        yield [
            AuthGuard::WEB->value,
            null,
        ];
        yield [
            AuthGuard::WEB->value,
            '',
        ];
    }

    public static function nonMatchingGuardDataProvider(): \Iterator
    {
        yield [
            AuthGuard::API->value,
            AuthGuard::WEB->value,
        ];
        yield [
            AuthGuard::WEB->value,
            AuthGuard::API->value,
        ];
    }

    #[TestDox('redirects if logged in with same guard or no guard (guessing guard)')]
    #[DataProvider('validGuardCombinationDataProvider')]
    public function testRedirectsIfAuthenticated(string $authenticatedGuard, null|string $requestGuard): void
    {
        $model = UserFactory::new()->makeOne();
        $this->actingAs($model, $authenticatedGuard);
        $request = Request::create(route('login'));
        $redirectIfAuthenticated = new RedirectIfAuthenticated();

        $response = $redirectIfAuthenticated->handle($request, static fn (Request $req): Request => $req, $requestGuard);

        $this->assertTrue($response->isRedirect(action(HomePageController::class)));
    }

    #[TestDox('dont redirect if logged in with different guard (means not logged in)')]
    #[DataProvider('nonMatchingGuardDataProvider')]
    public function testDontRedirectIfNonMatchingGuardProvided(string $authenticatedGuard, null|string $requestGuard): void
    {
        $model = UserFactory::new()->makeOne();
        $this->actingAs($model, $authenticatedGuard);
        $request = Request::create(route('login'));
        $redirectIfAuthenticated = new RedirectIfAuthenticated();

        $redirectIfAuthenticated->handle($request, function (Request $req): void {
            $this->assertInstanceOf(Request::class, $req);
        }, $requestGuard);
    }

    public function testDontRedirectIfUnauthenticated(): void
    {
        $request = Request::create(route('login'));
        $redirectIfAuthenticated = new RedirectIfAuthenticated();

        $redirectIfAuthenticated->handle($request, function (Request $req): void {
            $this->assertInstanceOf(Request::class, $req);
        });
    }
}
