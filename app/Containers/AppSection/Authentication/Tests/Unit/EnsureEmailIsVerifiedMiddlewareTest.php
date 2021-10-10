<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Exceptions\EmailNotVerifiedException;
use App\Containers\AppSection\Authentication\Middlewares\EnsureEmailIsVerified;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use Illuminate\Http\Request;

/**
 * Class EnsureEmailIsVerifiedMiddlewareTest.
 *
 * @group authentication
 * @group unit
 */
class EnsureEmailIsVerifiedMiddlewareTest extends TestCase
{
    private Request $request;
    private EnsureEmailIsVerified $middleware;

    protected function setUp(): void
    {
        parent::setUp();

        config(['appSection-authentication.require_email_verification' => true]);
        $this->request = Request::create('/user/profile');
        $this->middleware = new EnsureEmailIsVerified();
    }

    public function testIfEmailVerificationIsDisabled_ShouldSkipProcessing(): void
    {
        config(['appSection-authentication.require_email_verification' => false]);

        $this->middleware->handle($this->request, function ($req) {
            $this->assertInstanceOf(Request::class, $req);
        });
    }

    public function testIfUserNotAuthenticated_ShouldSkipProcessing(): void
    {
        $this->middleware->handle($this->request, function ($req) {
            $this->assertInstanceOf(Request::class, $req);
        });
    }

    public function testAPI_IfEmailVerificationIsRequired_GivenEmailNotVerified_ShouldThrowException(): void
    {
        $this->expectException(EmailNotVerifiedException::class);

        $user = $this->getTestingUser(['email_verified_at' => null]);
        $this->request->merge(['user' => $user]);
        $this->request->headers->set('Accept', 'application/json');
        $this->request->setUserResolver(fn () => $user);

        $this->middleware->handle($this->request, static function () {
        });
    }
}
