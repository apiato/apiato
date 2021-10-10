<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

/**
 * Class RedirectIfAuthenticatedMiddlewareTest.
 *
 * @group authentication
 * @group unit
 */
class RedirectIfAuthenticatedMiddlewareTest extends TestCase
{
    public function testRedirectIfAuthenticated(): void
    {
        $user = User::factory()->make();
        $this->actingAs($user, 'web');

        $request = Request::create(RouteServiceProvider::LOGIN);

        $middleware = new RedirectIfAuthenticated();

        $response = $middleware->handle($request, static function () {
        });

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSkipIfUnAuthenticated(): void
    {
        $request = Request::create(RouteServiceProvider::LOGIN);

        $middleware = new RedirectIfAuthenticated();

        $middleware->handle($request, function ($req) {
            $this->assertInstanceOf(Request::class, $req);
        });
    }
}
