<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserActionTest.
 *
 * @group authentication
 * @group unit
 */
class RegisterUserActionTest extends TestCase
{
    public function testAfterUserRegistration_GivenEmailVerificationEnabled_SendNotification(): void
    {
        if (!config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        Notification::fake();
        config(['appSection-authentication.require_email_verification', false]);
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];

        $request = new RegisterUserRequest($data);
        request()->merge($request->all());
        $user = app(RegisterUserAction::class)->run($request);

        $this->assertModelExists($user);
        $this->assertEquals(strtolower($data['email']), $user->email);
        Notification::assertSentTo($user, Welcome::class);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function testAfterUserRegistration_GivenEmailVerificationDisabled_ShouldNotSendVerifyEmailNotification(): void
    {
        if (config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        Notification::fake();
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];

        $request = new RegisterUserRequest($data);
        request()->merge($request->all());
        $user = app(RegisterUserAction::class)->run($request);

        $this->assertModelExists($user);
        $this->assertEquals(strtolower($data['email']), $user->email);
        Notification::assertSentTo($user, Welcome::class);
        Notification::assertNotSentTo($user, VerifyEmail::class);
    }
}
