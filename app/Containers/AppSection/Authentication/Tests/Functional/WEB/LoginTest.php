<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\WEB;

use App\Containers\AppSection\Authentication\Tests\Functional\WebTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\HttpFoundation\Cookie;

#[CoversClass(LoginController::class)]
final class LoginTest extends WebTestCase
{
    public function testCanLoginWithCredentials(): void
    {
        $user = User::factory()->createOne([
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ]);

        $response = $this
            ->post(action(LoginController::class), [
                'email' => $user->email,
                'password' => 'youShallNotPass',
                'remember' => true,
            ])
        ;

        $response->assertRedirect(action(HomePageController::class));
        $this->assertAuthenticatedAs($user, 'web');
    }

    public function testCanLoginViaRememberCookie(): void
    {
        $this->markTestIncomplete("Couldn't get this test to work");

        $user = User::factory()->createOne([
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ]);

        $response = $this
            ->post(action(LoginController::class), [
                'email' => $user->email,
                'password' => 'youShallNotPass',
                'remember' => true,
            ])
        ;

        $response->assertRedirect(action(HomePageController::class));
        $this->assertAuthenticatedAs($user, 'web');

        $rememberCookieName = Auth::guard('web')->getRecallerName();
        // Assert that the remember cookie is present in the response
        $response->assertCookie($rememberCookieName);
        // Retrieve the value of the remember cookie
        /** @var Cookie $rememberCookie */
        $rememberCookie = collect($response->headers->getCookies())
            ->first(fn (Cookie $cookie) => $cookie->getName() === $rememberCookieName);

        $this->flushSession();
        Route::get('test', static function () {
            return response()->json(['viaRemember' => Auth::guard('web')->viaRemember()]);
        })->middleware('auth:web');

        // Simulate a new request with a cleared session, using only the remember cookie
        $response = $this
            ->withCookie($rememberCookieName, $rememberCookie->getValue())
            ->get('test')
            ->assertOk();

        // Assert that the user was authenticated via the "remember" cookie
        $this->assertTrue($response->json('viaRemember'));
    }
}
